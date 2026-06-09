import re

with open('resources/js/components/HomeCobrand.vue', 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Text alignment "Chaque don de sang"
content = content.replace(
    'text-center lg:text-left">\n              <p>Chaque don',
    'text-left">\n              <p>Chaque don'
)

# 2. Hero Roby mobile styling
content = content.replace(
    'class="relative flex items-center justify-center shrink-0 h-full group hover:scale-105 transition-transform origin-bottom mt-16 md:mt-0">',
    'class="relative flex items-center justify-center shrink-0 h-full group hover:scale-105 transition-transform origin-bottom mt-16 md:mt-0 pr-[120px] md:pr-0">'
)

content = content.replace(
    '<div class="absolute bottom-[100%] left-1/2 -translate-x-1/2 md:translate-x-0 mb-4 md:mb-0 md:bottom-auto md:top-1/4 md:left-[90%] md:ml-6 bg-[#1a81e7] text-white p-3 md:p-4 border-[3px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] w-max max-w-[250px] md:max-w-[280px] z-50">',
    '<div class="absolute bottom-auto top-1/4 left-[75%] md:left-[90%] ml-2 md:ml-6 bg-[#1a81e7] text-white p-2 md:p-4 border-[2px] md:border-[3px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] w-max max-w-[150px] md:max-w-[280px] z-50">'
)

content = content.replace(
    '<p class="font-[\'Jersey_20\'] tracking-wide text-base md:text-xl leading-tight text-left">',
    '<p class="font-[\'Jersey_20\'] tracking-wide text-[14px] md:text-xl leading-tight text-left">'
)

content = content.replace(
    '<!-- Arrow pointing down (Mobile) -->',
    '<!-- Arrow pointing left (Mobile) -->'
)
content = content.replace(
    '<div class="md:hidden absolute -bottom-[15px] left-1/2 -translate-x-1/2 w-0 h-0 border-x-[12px] border-x-transparent border-t-[15px] border-t-black"></div>',
    '<div class="md:hidden absolute top-4 -left-[10px] w-0 h-0 border-y-[8px] border-y-transparent border-r-[10px] border-r-black"></div>'
)
content = content.replace(
    '<div class="md:hidden absolute -bottom-[10px] left-1/2 -translate-x-1/2 w-0 h-0 border-x-[9px] border-x-transparent border-t-[12px] border-t-[#1a81e7] z-10"></div>',
    '<div class="md:hidden absolute top-[16px] -left-[7px] w-0 h-0 border-y-[6px] border-y-transparent border-r-[8px] border-r-[#1a81e7] z-10"></div>'
)

# 3. Easter Egg Roby on mobile
mobile_roby_old = '''<div v-if="i === mobileRobyIndex" class="relative w-full h-full flex items-center justify-center cursor-pointer" :class="(isHovered || isClicked) ? 'z-40' : 'z-0'" @mouseenter="handleRobotHover(true)" @mouseleave="handleRobotHover(false)" @click="handleRobotClick">
                     <img src="/images/dono_default.png" alt="Robot" class="w-full h-full object-contain scale-[0.6]" />
                     <div v-show="isHovered || isClicked" class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 bg-[#0073e6] text-white font-['Jersey_20'] tracking-wide text-2xl px-4 py-2 border-2 border-black whitespace-nowrap shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] pointer-events-none">
                       Tu m'as trouvé !
                     </div>
                   </div>'''

mobile_roby_new = '''<a :href="quizzUrl" v-if="i === mobileRobyIndex" class="relative w-full h-full flex items-center justify-center cursor-pointer" :class="(isHovered || isClicked) ? 'z-40' : 'z-0'" @mouseenter="handleRobotHover(true)" @mouseleave="handleRobotHover(false)" @click="handleRobotClickMobile()">
                     <img src="/images/dono_default.png" alt="Robot" class="w-full h-full object-contain scale-[0.6]" />
                     <div v-show="isHovered || isClicked" class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 bg-[#0073e6] text-white font-['Jersey_20'] tracking-wide text-2xl px-4 py-2 border-2 border-black whitespace-nowrap shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] pointer-events-none">
                       Viens faire le quiz !
                     </div>
                   </a>'''
content = content.replace(mobile_roby_old, mobile_roby_new)

# Add handleRobotClickMobile logic
js_logic_old = '''const handleRobotClick = () => {
  isClicked.value = true;
  if (clickTimeout) clearTimeout(clickTimeout);
  clickTimeout = setTimeout(() => {
    isClicked.value = false;
  }, 3000);
};'''

js_logic_new = '''const handleRobotClick = () => {
  isClicked.value = true;
  if (clickTimeout) clearTimeout(clickTimeout);
  clickTimeout = setTimeout(() => {
    isClicked.value = false;
  }, 3000);
};

const handleRobotClickMobile = (e) => {
  if (window.innerWidth < 768) {
    if (!isClicked.value) {
      e.preventDefault();
      isClicked.value = true;
    }
  } else {
    handleRobotClick();
  }
};'''
content = content.replace(js_logic_old, js_logic_new)

with open('resources/js/components/HomeCobrand.vue', 'w', encoding='utf-8') as f:
    f.write(content)
print("Done")
