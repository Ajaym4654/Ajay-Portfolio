/* ===== Helpers ===== */
const $ = (sel) => document.querySelector(sel);
const $$ = (sel) => Array.from(document.querySelectorAll(sel));

/* ===== Date & Time ===== */
function updateClock(){
  const now = new Date();
  const dd = String(now.getDate()).padStart(2,'0');
  const mm = String(now.getMonth()+1).padStart(2,'0');
  const yy = String(now.getFullYear()).slice(-2);
  const hh = String(now.getHours()).padStart(2,'0');
  const min = String(now.getMinutes()).padStart(2,'0');
  const ss = String(now.getSeconds()).padStart(2,'0');
  $("#todayText").textContent = `${dd}/${mm}/${yy}`;
  $("#timeText").textContent = `${hh}:${min}:${ss}`;
  $("#yearNow").textContent = now.getFullYear();

  // greeting
  let g = "Hello";
  if (now.getHours() < 5) g = "Good Evening";
  else if (now.getHours() < 12) g = "Good morning";
  else if (now.getHours() < 17) g = "Good afternoon";
  else g = "Good evening";
  $("#greetText").textContent = `${g}`;
}
setInterval(updateClock, 1000); updateClock();

/* ===== Quotes (local list) ===== */
const QUOTES = [
  "Quality > speed. But both is best.",
  "Hire slow, fire fast. But mostly: hire right.",
  "Process beats chaos every time.",
  "Clarity turns applicants into hires.",
  "Keep it human, then optimize.",
  "A resume shows skills, but a conversation shows character.",
  "Good recruiters don’t just fill roles—they build teams.",
  "Every ‘no’ brings you closer to the right ‘yes’.",
  "Treat candidates like customers, because they are.",
  "Skills can be taught. Attitude can’t.",
  "Behind every hire is someone’s future changing.",
  "Listen more, sell less. Talent sells itself.",
  "Culture fit matters as much as culture add.",
  "Recruiting is matchmaking, not shopping.",
  "The best offer letter is backed by genuine respect.",
  "Don’t chase volume—chase alignment.",
  "A good hire is an investment, not an expense.",
  "People remember how you treated them, not just the outcome.",
  "Recruitment is marketing with a human heartbeat.",
  "Hire for potential, train for excellence."
];

document.getElementById("quote").textContent = `“${QUOTES[Math.floor(Math.random()*QUOTES.length)]}”`;

/* ===== Theme Toggle + Accent Picker ===== */
const themeBtn = $("#themeBtn");
function setTheme(mode){
  if(mode === "light") document.documentElement.classList.add("light");
  else document.documentElement.classList.remove("light");
  localStorage.setItem("theme", mode);
}
themeBtn.addEventListener("click", () => {
  const isLight = document.documentElement.classList.contains("light");
  setTheme(isLight ? "dark" : "light");
});
setTheme(localStorage.getItem("theme") || "dark");

function setAccent(hex){
  document.documentElement.style.setProperty("--accent", hex);
  localStorage.setItem("accent", hex);
  $$(".accent").forEach(a => a.classList.toggle("active", a.dataset.accent===hex));
}
$$(".accent").forEach(btn => btn.addEventListener("click", ()=> setAccent(btn.dataset.accent)));
setAccent(localStorage.getItem("accent") || getComputedStyle(document.documentElement).getPropertyValue("--accent"));

/* ===== Geolocation + Weather (Open-Meteo) ===== */
function getWeather(lat, lon){
const url = `https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current=temperature_2m,relative_humidity_2m,wind_speed_10m,precipitation`;
fetch(url)
  .then(r => r.json())
  .then(data => {
    const c = data.current || {};

    $("#wTemp").textContent = c.temperature_2m != null ? Math.round(c.temperature_2m) + "°C" : "--";
    $("#wHum").textContent = c.relative_humidity_2m != null ? Math.round(c.relative_humidity_2m) + "%" : "--";
    $("#wWind").textContent = c.wind_speed_10m != null ? Math.round(c.wind_speed_10m) + " km/h" : "--";
    $("#wRain").textContent = c.precipitation != null ? c.precipitation + " mm" : "--";
  })
  .catch(() => {});}

function setLocationLabel(lat, lon){
  $("#locText").textContent = `${lat.toFixed(2)}, ${lon.toFixed(2)}`;
}
if(navigator.geolocation){
  navigator.geolocation.getCurrentPosition(pos=>{
    const {latitude, longitude} = pos.coords;
    setLocationLabel(latitude, longitude);
    getWeather(latitude, longitude);
  }, ()=> $("#locText").textContent = "Location blocked");
}else{
  $("#locText").textContent = "Unsupported";
}

/* ===== Contact Form ===== */
const form = $("#contactForm");
const formMsg = $("#formMsg");
if(form){
  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    formMsg.textContent = "Sending…";
    const fd = new FormData(form);
    try{
      const res = await fetch("https://ajay-portfolio-m2jl.onrender.com/send.php", { method:"POST", body: fd });
      const data = await res.json();
      if(data.ok){ formMsg.textContent = "Sent! I'll get back to you soon."; form.reset(); }
      else{ formMsg.textContent = data.error || "Failed to send. Try again."; }
    }catch(_){ formMsg.textContent = "Sent"; }
  });
}

/* ===== Scroll reveal ===== */
const observer = new IntersectionObserver((entries)=>{
  entries.forEach(e=>{ if(e.isIntersecting) e.target.classList.add("show"); });
},{threshold:.12});
document.querySelectorAll(".section, .card, .proj").forEach(el=>observer.observe(el));

/* ===== Scroll to top ===== */
const toTop = $("#toTop");
window.addEventListener("scroll", ()=>{
  if(window.scrollY > 300) toTop.classList.add("show"); else toTop.classList.remove("show");
});
toTop.addEventListener("click", ()=> window.scrollTo({top:0, behavior:"smooth"}));

/* ===== Project Filters ===== */
const filterButtons = $$(".chip");
const projects = $$(".proj");
filterButtons.forEach(btn=>btn.addEventListener("click", ()=>{
  filterButtons.forEach(b=>b.classList.remove("active"));
  btn.classList.add("active");
  const f = btn.dataset.filter;
  projects.forEach(p=>{
    const show = f==="all" || p.dataset.cat === f;
    p.style.display = show ? "" : "none";
  });
}));

/* ===== 3D Tilt ===== */
function tilt(el){
  el.addEventListener("mousemove", (e)=>{
    const r = el.getBoundingClientRect();
    const cx = r.left + r.width/2;
    const cy = r.top + r.height/2;
    const dx = (e.clientX - cx)/r.width;
    const dy = (e.clientY - cy)/r.height;
    el.style.transform = `rotateX(${(-dy*6).toFixed(2)}deg) rotateY(${(dx*6).toFixed(2)}deg)`;
  });
  el.addEventListener("mouseleave", ()=> el.style.transform = "rotateX(0) rotateY(0)");
}
$$(".tilt").forEach(tilt);

/* ===== Simple Particles in Hero ===== */
const canvas = document.getElementById("particles");
if(canvas){
  const ctx = canvas.getContext("2d");
  let w, h, parts;
  function resize(){ w = canvas.width = canvas.offsetWidth; h = canvas.height = canvas.offsetHeight; parts = Array.from({length:40},()=>({x:Math.random()*w,y:Math.random()*h,vx:(Math.random()-.5)*0.6,vy:(Math.random()-.5)*0.6,r:1+Math.random()*2})) }
  function step(){
    ctx.clearRect(0,0,w,h);
    ctx.globalAlpha = .6;
    ctx.fillStyle = getComputedStyle(document.documentElement).getPropertyValue("--accent").trim() || "#00d3b4";
    parts.forEach(p=>{
      p.x += p.vx; p.y += p.vy;
      if(p.x<0||p.x>w) p.vx*=-1;
      if(p.y<0||p.y>h) p.vy*=-1;
      ctx.beginPath(); ctx.arc(p.x,p.y,p.r,0,Math.PI*2); ctx.fill();
    });
    requestAnimationFrame(step);
  }
  window.addEventListener("resize", resize);
  resize(); step();
}

// Toggle menu on click
document.addEventListener("DOMContentLoaded", () => {
  const hamburger = document.querySelector(".hamburger");
  const nav = document.querySelector(".nav");

  // Toggle menu
  hamburger.addEventListener("click", (e) => {
    e.stopPropagation(); // stop click bubbling
    nav.classList.toggle("show");
  });

  // Close when clicking outside
  document.addEventListener("click", (e) => {
    if (nav.classList.contains("show") && !nav.contains(e.target) && e.target !== hamburger) {
      nav.classList.remove("show");
    }
  });

  // Close when clicking a nav link
  nav.querySelectorAll("a").forEach(link => {
    link.addEventListener("click", () => {
      nav.classList.remove("show");
    });
  });
});


