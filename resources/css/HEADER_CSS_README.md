# Header CSS Extraction Summary

## Overview
Extracted all header-related CSS from `/Users/mubashirali/Sites/Laravel/mobilesentrix.com/mobilesentrix.com.html`

## Files Created

### 1. header-variables.css (14KB)
Contains all CSS custom properties (variables) used throughout the header and navigation.

**Categories:**
- Color variables (primary, secondary, grey tones, etc.)
- Box shadow variables
- Spacing and sizing variables
- Image/sprite URL variables
- Menu-specific variables
- Responsive breakpoint variables

**Total Variables:** 310

**Key Variables:**
- `--primary-color: #E3051B` - Main brand color (red)
- `--secondary-color: #000` - Secondary brand color (black)
- `--white-color: #FFF`
- `--dark-color: #000`
- `--menu-bg-light-color: #FEDFDE`
- `--search-input-radius: 40px`
- `--search-btn-bg-color: #E3051B`
- `--menu-search-btn-img: url(...)` - Search button icon
- `--header-sprites-bg: url(...)` - Header sprite icons

### 2. header-components.css (147KB)
Contains all CSS rules for header, navigation, mega menu, and related components.

**Total CSS Rules:** 965

**Major Component Classes:**

#### Header & Container
- `.ms-header` - Main header wrapper
- `.ms-container` - Header container with flex layout
- `.ms-searchbox` - Search box component
- `.hamburgermenu-icon` - Mobile hamburger menu icon
- `.logo` - Logo styles

#### Navigation
- `.nav-container` - Navigation container with cart
- `.ms-menucontainer` - Menu container wrapper
- `#nav` - Main navigation menu
- `.level0` - First level menu items
- `.slayouts-menu` - Menu layouts
- `.mob-desk-menu` - Mobile/desktop menu toggle

#### Shopping Cart
- `.block-cart` - Cart block in header
- `#cart-button` - Cart button with quantity

#### Mega Menu & Dropdowns
- `.dp-menu` - Dropdown menu
- `.dp-menu-drop` - Dropdown menu content
- `.submenu` - Submenu items
- `.m-overflows` - Scrollable menu content
- `.li-hover` - Hover state for menu items

#### Sticky Header
- `.sticky` - Fixed position header on scroll
- `.nav-container.sticky` - Sticky navigation styles

#### Search
- `.form-search` - Search form
- `.serch-box-new` - New search box design
- `.menu-search-part` - Menu search section

#### Responsive Elements
- `.country-picker` - Country selection dropdown
- `.msh-services` - Services section in header
- `.msfedex-destop` - FedEx desktop display

## Usage in Laravel

### Option 1: Include both files in app.css
```css
/* resources/css/app.css */
@import './header-variables.css';
@import './header-components.css';

/* Your custom styles */
```

### Option 2: Include separately in your layout
```blade
<!-- resources/views/components/layout/app.blade.php -->
@vite(['resources/css/header-variables.css', 'resources/css/header-components.css', 'resources/css/app.css'])
```

### Option 3: Merge into existing app.css
Copy the content from both files into your existing `resources/css/app.css` file.

## CSS Variables Usage Examples

```css
/* Using the extracted variables */
.my-custom-header {
    background-color: var(--primary-color);
    color: var(--white-color);
    box-shadow: var(--box-shadow-color-seven);
}

.my-button {
    background-color: var(--search-btn-bg-color);
    border-radius: var(--search-input-radius);
}
```

## Key CSS Classes Reference

### Header Layout
- `.ms-header .ms-container` - Max-width 1330px, flex layout
- `.ms-header .logo` - Logo block (115px width)
- `.ms-searchbox` - Search box (356px max-width)

### Navigation Menu
- `.ms-menucontainer #nav > li` - Top level menu items
- `.ms-menucontainer #nav > li > ul.level0` - Mega menu dropdown (1300px width)
- `.ms-menucontainer #nav .li-hover ul.level0` - Active/hover menu state

### Mega Menu Dropdowns
- `.dp-menu-drop` - Dropdown container with shadow
- `.m-overflows` - Scrollable content area (max-height: 505px)
- `ul.submenu li a` - Menu link styles

### Cart Component
- `.nav-container .block-cart` - Cart positioned right
- `.nav-container .block-cart #cart-button` - Cart button with sprite icon
- `.nav-container .block-cart:hover .block-content` - Cart dropdown on hover

## Font
- **Inter** (Google Fonts) - Imported at top of header-components.css
- Font weights: 100-900
- Supports italic and variable font

## Notes
- All measurements use a combination of px, %, and CSS variables
- Responsive breakpoints are defined via CSS variables (--m-search-width-dt, etc.)
- Sprite images are referenced via CSS variables for easy updates
- Box shadows use standardized variable names (--box-shadow-color-one through ten)
- The mega menu has a fixed height of 700px with overflow auto

## Color Scheme
- Primary Red: #E3051B
- Secondary Black: #000
- Background Light Grey: #F3F3F3
- Menu Light: #FEDFDE
- Multiple grey tones defined (--grey-color-tone-one through eleven)

## Browser Compatibility
- Uses modern CSS features (CSS variables, flexbox, transforms)
- Includes vendor prefixes for transitions (-webkit-, -moz-, -o-, -ms-)
- Requires modern browser support for CSS custom properties

---

**Generated:** December 13, 2024
**Source:** mobilesentrix.com.html
**Total Lines:** ~5,729 CSS rules
