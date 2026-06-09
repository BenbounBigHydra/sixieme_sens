const fs = require('fs');
const path = 'resources/js/components/HomeCobrand.vue';
let content = fs.readFileSync(path, 'utf-8');
let lines = content.split('\n');

// 148 to 153 are lines index 148 to 153, meaning lines[148] to lines[153] 
// wait, split('\n') is 0-indexed, so line 149 is lines[148].
// view_file said:
// 149:                  <div v-if="i === mobileRobyIndex" class="relative w-full h-full flex items-center justify-center cursor-pointer" :class="(isHovered || isClicked) ? 'z-40' : 'z-0'" @mouseenter="handleRobotHover(true)" @mouseleave="handleRobotHover(false)" @click="handleRobotClick">
// 150:                    <img src="/images/dono_default.png" alt="Robot" class="w-full h-full object-contain scale-[0.6]" />
// 151:                    <div v-show="isHovered || isClicked" class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 bg-[#0073e6] text-white font-['Jersey_20'] tracking-wide text-2xl px-4 py-2 border-2 border-black whitespace-nowrap shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] pointer-events-none">
// 152:                      Tu m'as trouvé !
// 153:                    </div>
// 154:                  </div>

lines[148] = '                  <a :href="quizzUrl" v-if="i === mobileRobyIndex" class="relative w-full h-full flex items-center justify-center cursor-pointer" :class="(isHovered || isClicked) ? \\'z-40\\' : \\'z-0\\'" @mouseenter="handleRobotHover(true)" @mouseleave="handleRobotHover(false)" @click="handleRobotClickMobile()">';
lines[149] = '                    <img src="/images/dono_default.png" alt="Robot" class="w-full h-full object-contain scale-[0.6]" />';
lines[150] = '                    <div v-show="isHovered || isClicked" class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 bg-[#0073e6] text-white font-[\\'Jersey_20\\'] tracking-wide text-2xl px-4 py-2 border-2 border-black whitespace-nowrap shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] pointer-events-none">';
lines[151] = '                      Viens faire le quiz !';
lines[152] = '                    </div>';
lines[153] = '                  </a>';

content = lines.join('\n');
fs.writeFileSync(path, content, 'utf-8');
console.log("Done");
