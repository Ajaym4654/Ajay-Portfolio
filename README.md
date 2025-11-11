# Ajay Mridha - Portfolio Website (HTML/CSS/JS)

A professional, modern portfolio website built with **pure HTML, CSS, and JavaScript** - no frameworks needed!

## 📁 Files

You have **3 files only** in `/app/frontend/public/`:

1. **index.html** - Complete HTML structure
2. **style.css** - All styling and animations
3. **script.js** - Interactive features and animations

## 🌐 Access Your Portfolio

**Live URL**: http://localhost:3000/index.html

Or simply open `index.html` directly in any browser!

## ✨ Features Included

### Design & Animation
- ✅ Clean white theme with professional aesthetics
- ✅ Animated circular background elements (floating gradients)
- ✅ Smooth scroll animations for all sections
- ✅ Hover effects on cards, buttons, and links
- ✅ Responsive design (mobile, tablet, desktop)
- ✅ Glass morphism effects with backdrop blur

### Sections
- ✅ **Hero** - Profile placeholder, name, title, description, CTA buttons
- ✅ **Education** - BTech CSE & High School with icons
- ✅ **Skills** - Soft Skills & Technical Skills with hover effects
- ✅ **Experience** - Timeline with 4 positions
- ✅ **Projects** - 4 project cards with images and tech badges
- ✅ **Contact** - Phone, email, address, social links, resume download
- ✅ **Footer** - Copyright and tagline

### Interactive Features
- ✅ Sticky navigation with scroll effect
- ✅ Mobile hamburger menu
- ✅ Smooth scroll to sections
- ✅ Scroll-to-top button
- ✅ Parallax background effect
- ✅ Section fade-in animations
- ✅ Project filter (extendable)
- ✅ Social media icons

## 🎨 Customization Guide

### 1. Add Your Profile Picture

**Option A: Replace Placeholder**
```html
<!-- In index.html, find (line ~36): -->
<div class=\"profile-image-placeholder\">
    <span>AM</span>
</div>

<!-- Replace with: -->
<img src=\"your-photo.jpg\" alt=\"Ajay Mridha\" style=\"width: 150px; height: 150px; border-radius: 50%; box-shadow: 0 20px 60px rgba(0,0,0,0.1);\">
```

**Option B: Keep Placeholder Style**
- Just place your photo in the same folder as index.html
- Update the `src` attribute

### 2. Update Project Links

In `index.html` (around line 172-243), update each project's GitHub link:

```html
<a href=\"https://github.com/YOUR_USERNAME/shopping-website\" target=\"_blank\" class=\"project-link\">
```

Update all 4 project links and the main GitHub button.

### 3. Update Social Media Links

In `index.html` (around line 333-357):

```html
<a href=\"https://facebook.com/YOUR_USERNAME\" target=\"_blank\" class=\"social-link\">
<a href=\"https://instagram.com/YOUR_USERNAME\" target=\"_blank\" class=\"social-link\">
<a href=\"https://linkedin.com/in/YOUR_USERNAME\" target=\"_blank\" class=\"social-link\">
<a href=\"https://github.com/YOUR_USERNAME\" target=\"_blank\" class=\"social-link\">
```

### 4. Add Your Resume

Place your `resume.pdf` file in the same folder as `index.html`:

```
/app/frontend/public/
├── index.html
├── style.css
├── script.js
└── resume.pdf  ← Add your resume here
```

The download button will automatically work!

### 5. Customize Colors

In `style.css`, find these color variables and modify:

```css
/* Primary Colors */
Background: #ffffff (white)
Text: #1a1a1a (black)
Gray Text: #4a5568, #718096

/* Accent Colors */
Blue: #3b82f6 (for tech skills, icons)
Green: #10b981 (for timeline, download button)
```

### 6. Change Project Images

Update image URLs in `index.html` (around line 176):

```html
<img src=\"https://your-image-url.com/image.jpg\" alt=\"Project Name\">
```

Or use local images:
```html
<img src=\"./images/project1.jpg\" alt=\"Project Name\">
```

### 7. Add/Edit Content

**Education**: Lines 79-103
**Skills**: Lines 108-144
**Experience**: Lines 150-232
**Projects**: Lines 237-319
**Contact**: Lines 325-371

## 🚀 How to Use

### Method 1: Local Development
1. Download all 3 files to your computer
2. Double-click `index.html` to open in browser
3. That's it!

### Method 2: Web Hosting
Upload to any hosting service:
- **GitHub Pages**: Free, perfect for portfolios
- **Netlify**: Free, drag & drop deployment
- **Vercel**: Free, instant deployment
- **Traditional hosting**: Any web host

Just upload these 3 files and you're live!

## 📱 Responsive Breakpoints

- **Desktop**: 1024px+ (full layout, 3-column projects)
- **Tablet**: 768px-1024px (2-column layout)
- **Mobile**: < 768px (single column, hamburger menu)

## 🎯 Browser Compatibility

Works on all modern browsers:
- ✅ Chrome/Edge (Chromium)
- ✅ Firefox
- ✅ Safari
- ✅ Opera
- ✅ Mobile browsers (iOS Safari, Chrome Mobile)

## 🔧 Technologies Used

- **HTML5** - Semantic markup
- **CSS3** - Animations, Grid, Flexbox
- **JavaScript (ES6)** - Interactivity
- **Feather Icons** - Icon library (CDN)

## 📋 Features Breakdown

### HTML Structure
```
index.html
├── Navigation (fixed, responsive)
├── Hero Section (profile, title, CTA)
├── Education Section (2 cards)
├── Skills Section (soft + technical)
├── Experience Section (timeline)
├── Projects Section (grid of 4)
├── Contact Section (info + socials)
└── Footer
```

### CSS Features
- CSS Grid & Flexbox layouts
- CSS Animations (@keyframes)
- Backdrop filters (blur effects)
- Custom transitions
- Responsive media queries
- Hover states & transforms

### JavaScript Features
- Intersection Observer API (scroll animations)
- Smooth scroll navigation
- Mobile menu toggle
- Scroll-to-top button
- Parallax background effect
- Active navigation highlighting

## 🎨 Design Principles

✅ **80/20 Gradient Rule**: Gradients on < 20% of page area
✅ **No Emojis**: Professional icon-based design
✅ **Whitespace**: Generous spacing for luxury feel
✅ **Animations**: Smooth, purposeful micro-interactions
✅ **Accessibility**: Semantic HTML, keyboard navigation

## 📦 What's Included

```
✅ Fixed navigation with scroll effects
✅ Animated circular backgrounds (4 floating circles)
✅ Profile placeholder (AM initials) - easily replaceable
✅ Hero section with CTA buttons
✅ Education cards with icons
✅ Skills tags with hover effects
✅ Experience timeline with 4 positions
✅ Project cards with overlay effects
✅ Contact information + social media icons
✅ Download resume button
✅ Scroll-to-top button
✅ Mobile hamburger menu
✅ 100% responsive design
✅ Smooth scroll animations
✅ All content from your requirements
```

## 🔄 Optional Enhancements

Want to add more features? Here are easy additions:

1. **Dark Mode**: Add a toggle button
2. **Contact Form**: Add PHP/FormSpree integration
3. **Blog Section**: Add more pages
4. **Testimonials**: Add client reviews
5. **Certificates**: Showcase achievements
6. **Analytics**: Add Google Analytics

## 📝 Quick Start Checklist

- [ ] Download all 3 files (index.html, style.css, script.js)
- [ ] Open index.html in browser to preview
- [ ] Replace \"AM\" placeholder with your photo
- [ ] Update all social media links (Facebook, Instagram, LinkedIn, GitHub)
- [ ] Update all project GitHub links (4 projects + main GitHub button)
- [ ] Add your resume.pdf file
- [ ] Customize colors if desired (in style.css)
- [ ] Test on mobile devices
- [ ] Deploy to hosting service

## 🌟 Deployment Options

### GitHub Pages (Recommended)
1. Create a GitHub repository
2. Upload index.html, style.css, script.js
3. Go to Settings > Pages
4. Select main branch
5. Your site is live at `username.github.io/repo-name`

### Netlify (Easiest)
1. Go to netlify.com
2. Drag & drop your folder
3. Site is live instantly!

### Vercel
1. Go to vercel.com
2. Import from GitHub or upload files
3. Deploy with one click

## 💡 Tips

1. **Images**: Optimize images before uploading (< 500KB each)
2. **Resume**: Keep PDF under 2MB for fast downloads
3. **Links**: Test all links after customization
4. **Mobile**: Always test on real mobile devices
5. **Speed**: Site loads in < 2 seconds (already optimized!)

## 📧 Support

Need help customizing? Contact:
- **Email**: ajaym4654@gmail.com
- **Location**: Noida, India
- **Phone**: +91 78956 60364

## 📄 File Locations

All your files are in: `/app/frontend/public/`

```
/app/frontend/public/
├── index.html     ← Main HTML file
├── style.css      ← All styling
├── script.js      ← All JavaScript
└── README.md      ← This file
```

## ✅ Final Steps

1. Open http://localhost:3000/index.html in your browser
2. Review all sections
3. Make customizations as needed
4. Download files to your computer
5. Deploy to your chosen hosting service
6. Share your portfolio URL!

---

**Built with passion and code** 💻

© 2025 Ajay Mridha. All rights reserved.
