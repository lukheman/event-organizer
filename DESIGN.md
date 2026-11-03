# Design System Inspired by Event Organizer Indonesia

> Auto-extracted from `https://eventorganizerindonesia.id/` on 2026-11-03

## 1. Visual Theme & Atmosphere

High-contrast dark mode with vivid accents — feels modern, technical, and focused.

The hero section leads with "Acara berskala nasional, dieksekusi tanpa kompromi." followed by "Partner event organizer korporat untuk perusahaan di seluruh Indonesia — dari konsep, produksi tekni".

**Key Characteristics:**
- Funnel Display as the heading font
- Funnel Sans as the body font for all running text
- Heading weight 800, letter-spacing -5.04px
- Dark background (#0d2620) as the primary canvas
- Primary accent `#f2b233` used for CTAs and brand highlights
- 6 shadow level(s) detected — tinted shadows
- Rounded corners (100px+) creating a friendly, approachable feel
- Tags: dark, rounded, colorful, bold-typography, monospace, sans-serif

## 2. Color Palette & Roles

### Primary
- **Primary Accent** (`#f2b233`) · `--color-primary`: Brand color, CTA backgrounds, link text, interactive highlights.
- **Secondary Accent** (`#25d366`) · `--color-secondary`: Secondary brand, hover states, complementary highlights.
- **Background** (`#0d2620`) · `--color-bg`: Page background, primary canvas.
- **Background Secondary** (`#08180f`) · `--color-bg-secondary`: Cards, surfaces, alternating sections.

### Text
- **Text Primary** (`#eadfc8`) · `--color-text`: Headings and body text.
- **Text Secondary** (`#8fa89e`) · `--color-text-secondary`: Muted text, captions, placeholders.

### Borders & Surfaces
- **Border** (`#08180f`) · `--color-border`: Dividers, outlines, input borders.

### Full Extracted Palette

| # | Hex | CSS Variable | Role | Area | Contrast |
|---|---|---|---|---|---|
| 1 | `#12332b` | `--palette-1` | section | large | text-light |
| 2 | `#08180f` | `--palette-2` | badge | large | text-light |
| 3 | `#eadfc8` | `--palette-3` | text-accent | large | text-dark |
| 4 | `#0d2620` | `--palette-4` | text-accent | large | text-light |
| 5 | `#f2b233` | `--palette-5` | button | medium | text-dark |
| 6 | `#ffffff` | `--palette-6` | block | medium | text-dark |
| 7 | `#25d366` | `--palette-7` | button | small | text-dark |
| 8 | `#22cdbe` | `--palette-8` | button | small | text-dark |
| 9 | `#8fa89e` | `--palette-9` | text-accent | small | text-dark |
| 10 | `#c9c2ae` | `--palette-10` | text-accent | small | text-dark |
| 11 | `#dcd3bd` | `--palette-11` | text-accent | small | text-dark |
| 12 | `#3f5a50` | `--palette-12` | text-accent | small | text-light |
| 13 | `#8a5a0b` | `--palette-13` | text-accent | small | text-light |

## 3. Typography Rules

- **Heading Font:** `Funnel Display`, sans-serif
- **Body Font:** `Funnel Sans`, sans-serif

### Type Hierarchy

| Role | Font | Size | Weight | Line Height | Letter Spacing |
|---|---|---|---|---|---|
| H1 | Funnel Display | 112px | 800 | 103.04px | -5.04px |
| H2 | Funnel Display | 84px | 800 | 78.96px | -3.36px |
| H3 | Funnel Display | 20px | 800 | 22px | -0.2px |
| Body | Martian Mono | 12px | 600 | 19.2px | 1.2px |
| Small | Martian Mono | 10px | 400 | 16px | 0.8px |

### Type Scale

| Token | Size | Suggested Usage |
|---|---|---|
| Display | `112px` | headings |
| H1 | `96px` | headings |
| H2 | `84px` | headings |
| H3 | `76px` | headings |
| H4 | `66px` | headings |
| Body L | `56px` | body / supporting text |
| Body | `54px` | body / supporting text |
| Small | `52px` | body / supporting text |
| XS | `40px` | body / supporting text |
| Caption | `36px` | body / supporting text |

## 4. Component Stylings

### Primary Button

```css
.btn-primary {
  background: transparent;
  color: #eadfc8;
  border-radius: 0px;
  padding: 0px 0px;
  font-size: 17px;
  font-weight: 400;
  border: none;
  cursor: pointer;
}
```

### Pill Button

```css
.btn-pill {
  background: transparent;
  color: #eadfc8;
  border-radius: 100px;
  padding: 10px 18px;
  font-size: 15px;
  font-weight: 600;
  border: 0.833333px solid rgba(234, 223, 200, 0.3);
  cursor: pointer;
}
```

### Pill Button 2

```css
.btn-pill-2 {
  background: #f2b233;
  color: #0d2620;
  border-radius: 100px;
  padding: 10px 18px;
  font-size: 15px;
  font-weight: 600;
  border: 0.833333px solid rgba(0, 0, 0, 0);
  cursor: pointer;
}
```

### Ghost Button

```css
.btn-ghost {
  background: transparent;
  color: #eadfc8;
  border-radius: 50px;
  padding: 0px 0px;
  font-size: 17px;
  font-weight: 400;
  border: none;
  cursor: pointer;
}
```

### Filled Button

```css
.btn-filled {
  background: #08180f;
  color: #eadfc8;
  border-radius: 18px;
  padding: 120px 72px;
  font-size: 17px;
  font-weight: 400;
  border: none;
  cursor: pointer;
}
```

## 5. Layout Principles

- **Base spacing unit:** `6px` — use multiples (12px, 18px, 24px, etc.)

### Spacing Scale (extracted from real elements)

| Token | Value | Role |
|---|---|---|
| spacing-1 | `6px` | element |
| spacing-2 | `10px` | element |
| spacing-3 | `1px` | element |
| spacing-4 | `7px` | element |
| spacing-5 | `8px` | element |
| spacing-6 | `12px` | element |
| spacing-7 | `24px` | card |
| spacing-8 | `28px` | card |

### Border Radius Scale

| Token | Value | Element |
|---|---|---|
| radius-pill | `100px` | pill |
| radius-card | `50px` | card |
| radius-button | `10px` | button |
| radius-button | `14px` | button |
| radius-card | `18px` | card |
| radius-subtle | `3px` | subtle |

## 6. Depth & Elevation

| Level | Shadow | Usage |
|---|---|---|
| Low | `rgba(234, 223, 200, 0.08) 0px -1px 0px 0px inset, rgba(0, 0, 0, 0.5) 0px 1px 0px...` | Cards, subtle elevation |
| Deep | `rgba(0, 0, 0, 0.4) 0px 14px 34px 0px` | Hero sections, deep layers |
| Deep | `rgba(0, 0, 0, 0.28) 0px 10px 26px 0px` | Hero sections, deep layers |
| High | `rgba(240, 138, 42, 0.55) 0px 0px 14px 0px` | Modals, floating elements |
| Deep | `rgba(34, 205, 190, 0.45) 0px 14px 40px 0px` | Hero sections, deep layers |

> **Note:** This site uses chromatic (color-tinted) shadows rather than pure black — this is a deliberate brand choice that adds warmth to elevation.

## 7. Do's and Don'ts

### Do
- Use `#0d2620` as the primary background color
- Use `Funnel Display` for all headings and `Funnel Sans` for body text
- Use `#f2b233` as the single dominant accent/CTA color
- Maintain `6px` as the base spacing unit — all gaps should be multiples
- Keep the overall feel dark — use dark surfaces throughout
- Use rounded corners (`100px`+) consistently for all interactive elements
- Make headlines large and bold — typography is the hero element
- Embrace bold color combinations — playful energy is the point
- Apply the shadow system for elevation — use the extracted shadow values
- Use weight 800 for headings to match the brand's typographic voice

### Don't
- Don't use colors outside the extracted palette without justification
- Don't substitute Funnel Display/Funnel Sans with generic alternatives
- Don't use irregular spacing — stick to 6px grid
- Don't introduce bright white surfaces — they break the dark palette
- Don't use sharp corners — they feel hostile in this rounded design language
- Don't use pure black (#000000) for text — use `#eadfc8` instead
- Don't add decorative elements not present in the original design — no badges, ribbons, banners, or ornaments unless the source site uses them
- Don't invent UI patterns the source site doesn't have — if the original has no NEW badge, don't add one just because a red is in the palette

## 8. Responsive Behavior

| Breakpoint | Width | Notes |
|---|---|---|
| Mobile | < 640px | Single column, stack sections, reduce font sizes ~80% |
| Tablet | 640–1024px | 2-column where appropriate, maintain spacing ratios |
| Desktop | 1024–1440px | Full layout as designed |
| Wide | > 1440px | Max-width container, center content |

- Touch targets: minimum 44×44px on mobile
- Maintain 6px base unit across breakpoints — only scale multipliers

## 9. Agent Prompt Guide

### Quick Color Reference

```
Background:  #0d2620
Text:        #eadfc8
Accent:      #f2b233
Secondary:   #25d366
Border:      #08180f
```

### Example Prompts

1. "Build a hero section with a `#0d2620` background, `Funnel Display` heading in `#eadfc8`, and a `#f2b233` CTA button with 100px radius."
2. "Create a pricing card using background `#08180f`, border `#08180f`, `Funnel Sans` for text, and 18px padding."
3. "Design a navigation bar — `#0d2620` background, `#eadfc8` links, `#f2b233` for active state."
4. "Build a feature grid with 3 columns, 18px gap, each card using the card component style."
5. "Create a footer with `#08180f` background, `#eadfc8` text, and 12px padding."

### Iteration Guide

1. Start with layout structure (sections, grid, spacing)
2. Apply colors from the palette — background first, then text, then accents
3. Set typography — font families, sizes from the type scale, weights
4. Add components — buttons, cards, inputs using the specs above
5. Apply border-radius consistently across all elements
6. Add shadows for depth — use the extracted shadow values, not defaults
7. Check responsive behavior — test mobile and tablet layouts
8. Final pass — verify all colors match, spacing is consistent, fonts are correct

## 10. CSS Custom Properties

> 20 custom properties extracted from `:root` / `html` stylesheets.

### Color Variables

| Variable | Value |
|---|---|
| `--em` | `#0D2620` |
| `--em-2` | `#12332B` |
| `--em-3` | `#08180F` |
| `--dot` | `#2E5A4D` |
| `--sand` | `#EADFC8` |
| `--soft` | `#C9C2AE` |
| `--muted` | `#8FA89E` |
| `--saf` | `#F2B233` |
| `--saf-ink` | `#8A5A0B` |
| `--ink-on-sand` | `#3F5A50` |
| `--line` | `rgba(234,223,200,.14)` |
| `--line-2` | `rgba(234,223,200,.3)` |

### Spacing Variables

| Variable | Value |
|---|---|
| `--wrap` | `1360px` |
| `--gut` | `24px` |
| `--r` | `18px` |
| `--head-h` | `76px` |

### Other Variables

| Variable | Value |
|---|---|
| `--f-display` | `'Funnel Display','Funnel Sans',system-ui,sans-serif` |
| `--f-sans` | `'Funnel Sans',system-ui,-apple-system,'Segoe UI',sans-serif` |
| `--f-mono` | `'Martian Mono',ui-monospace,SFMono-Regular,Menlo,monospace` |
| `--ease` | `cubic-bezier(.2,.8,.2,1)` |

