# Project Context and Design System: HUG Trophies

> **Overview**
> This document serves as the single source of truth for the development team and AI assistants. It contains all technical constraints, design tokens, and architectural decisions required to build the Vue components for the public facing site.

## 1. Technical Architecture

- **Frontend Logic:** Vue.js (Standalone components injected into Laravel Blade layouts).
- **Styling:** Tailwind CSS strictly using Flexbox for all structural layouts.
- **Backend:** Laravel 11 (handles routing and API endpoints).
- **Extraction Workflow:** Teleport HQ used to translate Figma wireframes into raw Vue code.

## 2. Design Tokens

### Brand Colors

- **hugDark:** `#322947` (Primary text and dark elements)
- **hugPurple:** `#4B5BAB` (Accents and secondary highlights)
- **hugBlue:** `#4DA6FF` (Primary actions and buttons)
- **hugCream:** `#FFE478` (Main application background)

### Typography

- **Title Font:** Jersey 20
    - Display 01 Desktop: Size 56, Line height 105
- **Body Font:** Inter
    - Heading 01 Desktop: Size 32, Line height 115
    - Body 01 Desktop: Size 16, Line height 110
    - Caption 01 Desktop: Size 12, Line height 100

## 3. Grid System and Dimensions

### Desktop Specifications (Target: 1280px)

- **Container Max Width:** 1120px
- **Columns:** 12 columns
- **Column Width:** 79px per column
- **Gutter Space:** 16px between each column
- **Outer Margins:** 80px padding on the left and right sides

### Mobile Specifications (Target: 360px)

- **Columns:** 4 columns
- **Column Width:** 70px per column
- **Gutter Space:** 16px between each column
- **Outer Margins:** 16px padding on the left and right sides

## 4. Application Routing

All navigation links within the header, footer, and main call to actions must strictly use these pre defined Laravel routes:

- **Accueil:** `/`
- **Trophées:** `/trophies`
- **Label:** `/label`
- **Entreprises:** `/companies`
- **Contact:** `/contact`

## 5. Media Assets Requirements

The following visual elements must be exported from Figma with transparent backgrounds and placed inside the public directory before component integration:

- Main HUG logo
- Pixel art trophy illustrations (Gold, Ambassador, Engagement)
- Pixel art background grid of people
- UI Icons: Blue downward arrow and mobile menu hamburger icon
