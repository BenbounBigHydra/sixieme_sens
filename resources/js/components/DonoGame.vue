<template>
  <div class="dono-game-container flex flex-col items-center justify-center w-full min-h-screen bg-[#fffbf1] relative overflow-hidden" @mousedown="jump" @touchstart.prevent="jump">
    <div v-if="isGameOver" class="absolute inset-0 flex flex-col items-center justify-center z-10 bg-white/50 backdrop-blur-sm">
      <h2 class="font-['Jersey_20'] text-5xl md:text-7xl mb-4 text-black">Game Over</h2>
      <p class="font-['Jersey_20'] text-3xl md:text-5xl mb-8 text-black">Score: {{ Math.floor(score) }}</p>
      <button @mousedown.stop="resetGame" @touchstart.stop="resetGame" class="px-6 py-3 bg-[#0073e6] text-white font-['Jersey_20'] text-2xl md:text-3xl border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1 hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] transition-all">Rejouer</button>
    </div>
    
    <div class="absolute top-8 left-1/2 -translate-x-1/2 font-['Jersey_20'] text-5xl md:text-6xl text-black">
      Score: {{ Math.floor(score) }}
    </div>

    <div class="w-full max-w-4xl px-4 flex flex-col items-center">
      <canvas ref="gameCanvas" width="800" height="300" class="border-b-[3px] border-black max-w-full bg-[#fffbf1]"></canvas>
      
      <div class="mt-8 text-center text-gray-500 font-['Jersey_20'] text-xl md:text-2xl animate-pulse">
        Appuyez sur Espace ou Cliquez pour sauter
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'DonoGame',
  data() {
    return {
      canvas: null,
      ctx: null,
      animationFrame: null,
      isGameOver: false,
      score: 0,
      donoImg: null,
      lastTime: 0,
      player: {
        x: 50,
        y: 0,
        width: 60,
        height: 60,
        vy: 0,
        gravity: 1.2,
        jumpPower: -18,
        isGrounded: true
      },
      obstacles: [],
      gameSpeed: 6,
      obstacleSpawnTimer: 0,
      obsImages: {},
    };
  },
  mounted() {
    this.canvas = this.$refs.gameCanvas;
    this.ctx = this.canvas.getContext('2d');
    this.player.y = this.canvas.height - this.player.height;
    
    this.donoImg = new Image();
    this.donoImg.src = '/images/dono_default.png';
    this.donoImg.onload = () => {
      // Fix aspect ratio of player based on image
      if (this.donoImg.naturalHeight) {
        const aspectRatio = this.donoImg.naturalWidth / this.donoImg.naturalHeight;
        this.player.width = this.player.height * aspectRatio;
      }
      this.checkAllImagesLoaded();
    };

    const obsUrls = ['/images/Game/Cactus.svg', '/images/Game/Tree.svg', '/images/Game/Bird.svg', '/images/Game/UFO.svg'];
    let loadedCount = 0;
    obsUrls.forEach(url => {
      const img = new Image();
      img.src = url;
      const name = url.split('/').pop().split('.')[0];
      this.obsImages[name] = img;
      img.onload = () => {
        loadedCount++;
        if (loadedCount === obsUrls.length) {
           this.checkAllImagesLoaded();
        }
      };
    });

    window.addEventListener('keydown', this.handleKeydown);
    
    // Scale canvas slightly for mobile if needed, though max-w-full handles most of it.
  },
  beforeUnmount() {
    window.removeEventListener('keydown', this.handleKeydown);
    if (this.animationFrame) {
      cancelAnimationFrame(this.animationFrame);
    }
  },
  methods: {
    checkAllImagesLoaded() {
      // Wait for donoImg and all 4 obstacle images to start
      if (this.donoImg.complete && Object.keys(this.obsImages).length === 4) {
         if (!this.animationFrame) {
             this.startGame();
         }
      }
    },
    handleKeydown(e) {
      if (e.code === 'Space' || e.code === 'ArrowUp') {
        e.preventDefault();
        this.jump();
      }
    },
    jump() {
      if (this.isGameOver) {
        return;
      }
      if (this.player.isGrounded) {
        this.player.vy = this.player.jumpPower;
        this.player.isGrounded = false;
      }
    },
    resetGame() {
      this.isGameOver = false;
      this.score = 0;
      this.obstacles = [];
      this.gameSpeed = 6;
      this.player.y = this.canvas.height - this.player.height;
      this.player.vy = 0;
      this.player.isGrounded = true;
      this.startGame();
    },
    startGame() {
      if (this.animationFrame) cancelAnimationFrame(this.animationFrame);
      this.lastTime = performance.now();
      this.gameLoop(this.lastTime);
    },
    gameLoop(time) {
      if (this.isGameOver) return;

      const deltaTime = time - this.lastTime;
      this.lastTime = time;

      this.update(deltaTime);
      this.draw();

      this.animationFrame = requestAnimationFrame(this.gameLoop);
    },
    update(deltaTime) {
      // Adjust game speed slightly based on framerate to be consistent (basic implementation)
      const timeScale = Math.min(deltaTime / 16.66, 2); // Cap at 2x to prevent massive jumps on lag
      
      // Speed up slowly
      this.gameSpeed += 0.002 * timeScale;

      // Player physics
      this.player.vy += this.player.gravity * timeScale;
      this.player.y += this.player.vy * timeScale;

      // Ground collision
      if (this.player.y >= this.canvas.height - this.player.height) {
        this.player.y = this.canvas.height - this.player.height;
        this.player.vy = 0;
        this.player.isGrounded = true;
      }

      // Obstacles
      this.obstacleSpawnTimer -= timeScale;
      if (this.obstacleSpawnTimer <= 0) {
        this.spawnObstacle();
        
        // Calculate dynamic minimum distance based on jump time to ensure fairness
        // Jump takes ~30 frames. Distance covered = 30 * gameSpeed.
        // Add 100px for obstacle width and a small margin.
        const minDistance = (30 * this.gameSpeed) + 100;
        const maxDistance = minDistance + 400 + (Math.random() * 200);
        
        const distanceToNext = minDistance + Math.random() * (maxDistance - minDistance);
        
        // Convert distance back to frames for the timer
        this.obstacleSpawnTimer = distanceToNext / this.gameSpeed;
      }

      for (let i = 0; i < this.obstacles.length; i++) {
        let obs = this.obstacles[i];
        obs.x -= this.gameSpeed * timeScale;

        // Score tracking
        if (!obs.passed && obs.x + obs.width < this.player.x) {
            obs.passed = true;
            this.score += 1;
        }

        // Collision detection (with slight forgiveness padding)
        const pLeft = this.player.x + 15;
        const pRight = this.player.x + this.player.width - 15;
        const pTop = this.player.y + 10;
        const pBottom = this.player.y + this.player.height - 5;

        if (
          pLeft < obs.x + obs.width &&
          pRight > obs.x &&
          pTop < obs.y + obs.height &&
          pBottom > obs.y
        ) {
           this.isGameOver = true;
        }
      }

      // Remove off-screen obstacles
      this.obstacles = this.obstacles.filter(obs => obs.x + obs.width > 0);
    },
    spawnObstacle() {
      const types = ['Cactus', 'Tree', 'Bird', 'UFO'];
      const type = types[Math.floor(Math.random() * types.length)];
      const img = this.obsImages[type];
      
      // Default sizes (80px, 30% larger than 60)
      let width = 80;
      let height = 80;
      
      if (type === 'UFO') {
          height = 160;
      }
      
      if (img && img.naturalHeight) {
          width = height * (img.naturalWidth / img.naturalHeight);
      }
      
      // Shift ground obstacles down by 15px to account for SVG padding
      let y = this.canvas.height - height + 15; 
      
      if (type === 'Bird') {
          // Flying obstacles: raised to clear the player safely when not jumping.
          y = this.canvas.height - 145; 
      } else if (type === 'UFO') {
          // UFO is twice as big, needs to be placed higher
          // y + 160 (height) = canvas.height - 65. Player top is canvas.height - 60.
          y = this.canvas.height - 225;
      }
      
      this.obstacles.push({
          x: this.canvas.width,
          y: y,
          width: width,
          height: height,
          type: type,
          passed: false
      });
    },
    draw() {
      // Clear canvas
      this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

      // Draw Player
      if (this.donoImg && this.donoImg.complete) {
        // Draw the image
        this.ctx.drawImage(this.donoImg, this.player.x, this.player.y, this.player.width, this.player.height);
      } else {
        this.ctx.fillStyle = '#0073e6';
        this.ctx.fillRect(this.player.x, this.player.y, this.player.width, this.player.height);
      }

      // Draw Obstacles (SVG images)
      for (let obs of this.obstacles) {
        const img = this.obsImages[obs.type];
        if (img && img.complete && img.naturalWidth !== 0) {
           this.ctx.drawImage(img, obs.x, obs.y, obs.width, obs.height);
        } else {
           // Fallback
           this.ctx.fillStyle = '#000000';
           this.ctx.fillRect(obs.x, obs.y, obs.width, obs.height);
        }
      }
    }
  }
};
</script>

<style scoped>
.dono-game-container {
  font-family: 'Jersey 20', sans-serif;
}
</style>
