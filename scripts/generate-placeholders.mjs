// Menghasilkan placeholder gambar (SVG) untuk website Gado Gado Kampoeng Biru (Laravel).
// Jalankan: node scripts/generate-placeholders.mjs dari root project.
// Foto asli customer dapat menggantikan file-file SVG ini nanti (nama file sama).

import { mkdirSync, writeFileSync } from 'node:fs'
import { join, dirname } from 'node:path'
import { fileURLToPath } from 'node:url'

const root = join(dirname(fileURLToPath(import.meta.url)), '..')
const img = (...p) => join(root, 'public', 'images', ...p)

const CREAM_A = '#F6EFE0'
const CREAM_B = '#EFE2C4'
const NAVY = '#16293E'
const NAVY_DARK = '#0D1B2B'
const ACCENT = '#E89633'
const LEAF = '#6D9450'

function wrap(body, w, h, extraDefs = '') {
  return `<svg xmlns="http://www.w3.org/2000/svg" width="${w}" height="${h}" viewBox="0 0 ${w} ${h}" fill="none">
<defs>
  <linearGradient id="bg" x1="0" y1="0" x2="0" y2="1">
    <stop offset="0" stop-color="${CREAM_A}"/>
    <stop offset="1" stop-color="${CREAM_B}"/>
  </linearGradient>
  <radialGradient id="glow" cx="0.25" cy="0.2" r="0.9">
    <stop offset="0" stop-color="${ACCENT}" stop-opacity="0.35"/>
    <stop offset="1" stop-color="${ACCENT}" stop-opacity="0"/>
  </radialGradient>
  ${extraDefs}
</defs>
${body}</svg>`
}

function label(w, text) {
  return `<text x="${w / 2}" y="${w / 2 + 20}" text-anchor="middle" font-family="ui-sans-serif, system-ui, sans-serif" font-size="19" font-weight="700" letter-spacing="4" fill="${NAVY}" opacity="0.55">${text.toUpperCase()}</text>`
}

function tag(w, text, cy = 38) {
  return `<text x="${w / 2}" y="${cy}" text-anchor="middle" font-family="ui-sans-serif, system-ui, sans-serif" font-size="13" font-weight="600" letter-spacing="3" fill="${ACCENT}" opacity="0.9">${text.toUpperCase()}</text>`
}

function plateArt({ w = 800, h = 600, labelText = 'Menu', accent = ACCENT }) {
  return `<rect width="${w}" height="${h}" fill="url(#bg)"/>
<circle cx="${w * 0.78}" cy="120" r="${w * 0.28}" fill="url(#glow)"/>
<ellipse cx="${w * 0.5}" cy="${h * 0.78}" rx="${w * 0.4}" ry="70" fill="#DFCBA5"/>
<ellipse cx="${w * 0.5}" cy="${h * 0.76}" rx="${w * 0.36}" ry="62" fill="#D0B88A"/>
<ellipse cx="${w * 0.5}" cy="${h * 0.53}" rx="${w * 0.27}" ry="72" fill="#FFFFFF" stroke="#D9C9A6" stroke-width="4"/>
<ellipse cx="${w * 0.5}" cy="${h * 0.52}" rx="${w * 0.19}" ry="52" fill="#F3ECD9"/>
<path d="M ${w * 0.5 - w * 0.16} ${h * 0.52} C ${w * 0.5 - w * 0.2} ${h * 0.52 - h * 0.2}, ${w * 0.5 - w * 0.08} ${h * 0.52 - h * 0.26}, ${w * 0.5} ${h * 0.52 - h * 0.26} C ${w * 0.5 + w * 0.08} ${h * 0.52 - h * 0.26}, ${w * 0.5 + w * 0.2} ${h * 0.52 - h * 0.2}, ${w * 0.5 + w * 0.16} ${h * 0.52} C ${w * 0.5} ${h * 0.52 + h * 0.09}, ${w * 0.5 - w * 0.16} ${h * 0.52}, ${w * 0.5 - w * 0.16} ${h * 0.52} Z" fill="${LEAF}"/>
<path d="M ${w * 0.5 - w * 0.11} ${h * 0.5} C ${w * 0.5 - w * 0.14} ${h * 0.5 - h * 0.14}, ${w * 0.5 - w * 0.05} ${h * 0.5 - h * 0.18}, ${w * 0.5} ${h * 0.5 - h * 0.18} C ${w * 0.5 + w * 0.05} ${h * 0.5 - h * 0.18}, ${w * 0.5 + w * 0.14} ${h * 0.5 - h * 0.14}, ${w * 0.5 + w * 0.11} ${h * 0.5} C ${w * 0.5} ${h * 0.5 + h * 0.06}, ${w * 0.5 - w * 0.11} ${h * 0.5}, ${w * 0.5 - w * 0.11} ${h * 0.5} Z" fill="${accent}"/>
<circle cx="${w * 0.5 - w * 0.06}" cy="${h * 0.5 - h * 0.1}" r="8" fill="#FFFFFF" opacity="0.7"/>
<ellipse cx="${w * 0.5 - w * 0.17}" cy="${h * 0.45}" rx="16" ry="26" fill="#FFFFFF" opacity="0.6" transform="rotate(-24 ${w * 0.5 - w * 0.17} ${h * 0.45})"/>
<ellipse cx="${w * 0.5 + w * 0.17}" cy="${h * 0.45}" rx="16" ry="26" fill="#FFFFFF" opacity="0.6" transform="rotate(24 ${w * 0.5 + w * 0.17} ${h * 0.45})"/>
<line x1="${w * 0.74}" y1="${h * 0.3}" x2="${w * 0.64}" y2="${h * 0.62}" stroke="${NAVY}" stroke-opacity="0.7" stroke-width="5" stroke-linecap="round"/><line x1="${w * 0.79}" y1="${h * 0.34}" x2="${w * 0.69}" y2="${h * 0.66}" stroke="${ACCENT}" stroke-width="5" stroke-linecap="round"/>
${tag(w, 'Kampoeng Biru')}
${label(w, labelText)}<text x="${w / 2}" y="${h * 0.55 + 120}" text-anchor="middle" font-family="ui-sans-serif, system-ui, sans-serif" font-size="12" font-weight="500" letter-spacing="2" fill="${NAVY}" opacity="0.35">GANTI DENGAN FOTO ASLI</text>`
}

function bowlArt({ w = 800, h = 600, labelText = 'Menu', accent = ACCENT }) {
  const cx = w * 0.5
  const cy = h * 0.56
  return `<rect width="${w}" height="${h}" fill="url(#bg)"/>
<circle cx="${cx}" cy="110" r="${w * 0.3}" fill="url(#glow)"/>
<ellipse cx="${cx}" cy="${h * 0.8}" rx="${w * 0.38}" ry="64" fill="#DFCBA5"/>
<ellipse cx="${cx}" cy="${h * 0.78}" rx="${w * 0.34}" ry="56" fill="#D0B88A"/>
<path d="M ${cx - w * 0.2} ${cy} C ${cx - w * 0.2} ${h * 0.72}, ${cx + w * 0.2} ${h * 0.72}, ${cx + w * 0.2} ${cy} L ${cx + w * 0.16} ${cy - h * 0.02} C ${cx + w * 0.12} ${cy - h * 0.22}, ${cx - w * 0.12} ${cy - h * 0.22}, ${cx - w * 0.16} ${cy - h * 0.02} Z" fill="#FFFFFF" stroke="#D9C9A6" stroke-width="4"/>
<path d="M ${cx - w * 0.13} ${cy - h * 0.03} C ${cx - w * 0.16} ${cy - h * 0.28}, ${cx - w * 0.05} ${cy - h * 0.34}, ${cx} ${cy - h * 0.34} C ${cx + w * 0.05} ${cy - h * 0.34}, ${cx + w * 0.16} ${cy - h * 0.28}, ${cx + w * 0.13} ${cy - h * 0.03} C ${cx} ${cy + h * 0.04}, ${cx - w * 0.13} ${cy - h * 0.03}, ${cx - w * 0.13} ${cy - h * 0.03} Z" fill="${LEAF}"/>
<path d="M ${cx - w * 0.08} ${cy - h * 0.06} C ${cx - w * 0.1} ${cy - h * 0.18}, ${cx - w * 0.03} ${cy - h * 0.22}, ${cx} ${cy - h * 0.22} C ${cx + w * 0.03} ${cy - h * 0.22}, ${cx + w * 0.1} ${cy - h * 0.18}, ${cx + w * 0.08} ${cy - h * 0.06} C ${cx} ${cy - h * 0.01}, ${cx - w * 0.08} ${cy - h * 0.06}, ${cx - w * 0.08} ${cy - h * 0.06} Z" fill="${accent}"/>
<circle cx="${cx - w * 0.05}" cy="${cy - h * 0.13}" r="6" fill="#FFFFFF" opacity="0.7"/>
<ellipse cx="${cx - w * 0.15}" cy="${cy - h * 0.16}" rx="14" ry="22" fill="#FFFFFF" opacity="0.6" transform="rotate(-20 ${cx - w * 0.15} ${cy - h * 0.16})"/>
<ellipse cx="${cx + w * 0.15}" cy="${cy - h * 0.16}" rx="14" ry="22" fill="#FFFFFF" opacity="0.6" transform="rotate(20 ${cx + w * 0.15} ${cy - h * 0.16})"/>
${tag(w, 'Kampoeng Biru')}
${label(w, labelText)}<text x="${w / 2}" y="${h * 0.55 + 110}" text-anchor="middle" font-family="ui-sans-serif, system-ui, sans-serif" font-size="12" font-weight="500" letter-spacing="2" fill="${NAVY}" opacity="0.35">GANTI DENGAN FOTO ASLI</text>`
}

function drinkArt({ w = 800, h = 600, labelText = 'Menu', accent = ACCENT }) {
  const cx = w * 0.5
  const top = h * 0.28
  const bot = h * 0.66
  const gw = w * 0.16
  return `<rect width="${w}" height="${h}" fill="url(#bg)"/>
<circle cx="${w * 0.24}" cy="120" r="${w * 0.24}" fill="url(#glow)"/>
<ellipse cx="${cx}" cy="${h * 0.78}" rx="${w * 0.38}" ry="64" fill="#DFCBA5"/>
<ellipse cx="${cx}" cy="${h * 0.76}" rx="${w * 0.34}" ry="56" fill="#D0B88A"/>
<path d="M ${cx - gw} ${top} L ${cx + gw} ${top} L ${cx + gw - w * 0.02} ${bot} Q ${cx} ${bot + 34} ${cx - gw + w * 0.02} ${bot} Z" fill="#DFE9F3" stroke="#B8C8DA" stroke-width="4"/>
<rect x="${cx - gw + w * 0.006}" y="${top + 14}" width="${gw * 1.96}" height="${bot - top - 20}" rx="6" fill="${accent}" opacity="0.85"/>
<rect x="${cx - gw + w * 0.006}" y="${top + 14 + (bot - top - 20) * 0.55}" width="${gw * 1.96}" height="${(bot - top - 20) * 0.45}" fill="${NAVY}" opacity="0.25"/>
<rect x="${cx - gw + w * 0.02}" y="${top + 26}" width="${gw * 0.34}" height="52" rx="6" fill="#FFFFFF" opacity="0.75" transform="rotate(7 ${cx - gw + w * 0.02} ${top + 26})"/>
<rect x="${cx - gw + w * 0.44}" y="${top + 26}" width="${gw * 0.3}" height="48" rx="6" fill="#FFFFFF" opacity="0.75" transform="rotate(-6 ${cx - gw + w * 0.44} ${top + 26})"/>
<line x1="${cx - gw * 0.25}" y1="${top - 30}" x2="${cx + gw * 0.3}" y2="${top + 16}" stroke="#C8A1E0" stroke-width="7" stroke-linecap="round"/>
<line x1="${cx - gw * 0.18}" y1="${top - 22}" x2="${cx + gw * 0.18}" y2="${top - 2}" stroke="#FFFFFF" stroke-width="3" opacity="0.7"/>
${tag(w, 'Kampoeng Biru')}
${label(w, labelText)}<text x="${w / 2}" y="${h * 0.55 + 100}" text-anchor="middle" font-family="ui-sans-serif, system-ui, sans-serif" font-size="12" font-weight="500" letter-spacing="2" fill="${NAVY}" opacity="0.35">GANTI DENGAN FOTO ASLI</text>`
}

function interiorArt({ w = 800, h = 600, labelText = 'Suasana', accent = NAVY }) {
  const cx = w * 0.5
  return `<rect width="${w}" height="${h}" fill="url(#bg)"/>
<rect y="0" width="${w}" height="${h * 0.55}" fill="#EDE4CE"/>
<circle cx="${w * 0.16}" cy="80" r="150" fill="url(#glow)"/>
<circle cx="${w * 0.85}" cy="90" r="${w * 0.2}" fill="${NAVY}" opacity="0.06"/>
<rect x="${w * 0.12}" y="${h * 0.12}" width="${w * 0.3}" height="${h * 0.3}" rx="10" fill="#D9E4EE"/>
<line x1="${w * 0.27}" y1="${h * 0.12}" x2="${w * 0.27}" y2="${h * 0.42}" stroke="#AFC6DA" stroke-width="6"/>
<line x1="${w * 0.12}" y1="${h * 0.27}" x2="${w * 0.42}" y2="${h * 0.27}" stroke="#AFC6DA" stroke-width="6"/>
<rect x="${w * 0.12 + 12}" y="${h * 0.12 + 12}" width="${w * 0.3 - 24}" height="${h * 0.3 - 24}" rx="8" fill="#EAF1FA"/>
<g>
  <line x1="${cx}" y1="${h * 0.05}" x2="${cx}" y2="${h * 0.2}" stroke="${NAVY}" stroke-width="4" stroke-opacity="0.7"/>
  <path d="M ${cx - 34} ${h * 0.2} L ${cx + 34} ${h * 0.2} L ${cx + 24} ${h * 0.42} L ${cx - 24} ${h * 0.42} Z" fill="${accent}"/>
  <circle cx="${cx}" cy="${h * 0.38}" r="10" fill="#FFF4DC" opacity="0.9"/>
</g>
<rect x="${w * 0.62}" y="${h * 0.3}" width="${w * 0.18}" height="${w * 0.18}" rx="12" fill="#CFA87C"/>
<rect x="${w * 0.68}" y="${h * 0.24}" width="${w * 0.06}" height="${h * 0.06}" rx="6" fill="#C09A70"/>
<ellipse cx="${w * 0.71}" cy="${h * 0.36}" rx="${w * 0.045}" ry="${w * 0.05}" fill="#8FAE6E"/>
<ellipse cx="${w * 0.71}" cy="${h * 0.36}" rx="${w * 0.03}" ry="${w * 0.035}" fill="#54783D"/>
<ellipse cx="${cx}" cy="${h * 0.72}" rx="${w * 0.42}" ry="80" fill="#E9DCC0"/>
<ellipse cx="${cx}" cy="${h * 0.72}" rx="${w * 0.34}" ry="64" fill="#F4ECDB"/>
<ellipse cx="${cx - w * 0.09}" cy="${h * 0.66}" rx="${w * 0.2}" ry="50" fill="#FFFFFF" stroke="#D9C9A6" stroke-width="3"/>
<ellipse cx="${cx + w * 0.09}" cy="${h * 0.7}" rx="${w * 0.17}" ry="44" fill="#FFFFFF" stroke="#D9C9A6" stroke-width="3"/>
<path d="M ${cx - w * 0.13} ${h * 0.62} Q ${cx - w * 0.09} ${h * 0.52} ${cx - w * 0.03} ${h * 0.62} Z" fill="${LEAF}"/>
${tag(w, 'Kampoeng Biru')}
${label(w, labelText)}<text x="${w / 2}" y="${h * 0.55 + 110}" text-anchor="middle" font-family="ui-sans-serif, system-ui, sans-serif" font-size="12" font-weight="500" letter-spacing="2" fill="${NAVY}" opacity="0.35">GANTI DENGAN FOTO ASLI</text>`
}

function logoArt() {
  const s = 512
  return `<svg xmlns="http://www.w3.org/2000/svg" width="${s}" height="${s}" viewBox="0 0 ${s} ${s}" fill="none">
<defs>
  <linearGradient id="lg" x1="0" y1="0" x2="1" y2="1">
    <stop offset="0" stop-color="${NAVY}"/>
    <stop offset="1" stop-color="${NAVY_DARK}"/>
  </linearGradient>
</defs>
<rect width="${s}" height="${s}" rx="120" fill="url(#lg)"/>
<circle cx="${s * 0.5}" cy="${s * 0.45}" r="${s * 0.3}" fill="${ACCENT}" opacity="0.16"/>
<path d="M ${s * 0.3} ${s * 0.52} C ${s * 0.3} ${s * 0.62}, ${s * 0.7} ${s * 0.62}, ${s * 0.7} ${s * 0.52} L ${s * 0.67} ${s * 0.4} C ${s * 0.63} ${s * 0.3}, ${s * 0.37} ${s * 0.3}, ${s * 0.33} ${s * 0.4} Z" fill="${CREAM_A}"/>
<path d="M ${s * 0.36} ${s * 0.49} C ${s * 0.34} ${s * 0.39}, ${s * 0.42} ${s * 0.36}, ${s * 0.5} ${s * 0.3} C ${s * 0.58} ${s * 0.36}, ${s * 0.66} ${s * 0.39}, ${s * 0.64} ${s * 0.49} C ${s * 0.5} ${s * 0.54}, ${s * 0.36} ${s * 0.49}, ${s * 0.36} ${s * 0.49} Z" fill="${LEAF}"/>
<circle cx="${s * 0.43}" cy="${s * 0.42}" r="${s * 0.02}" fill="${ACCENT}"/>
<circle cx="${s * 0.5}" cy="${s * 0.38}" r="${s * 0.018}" fill="${ACCENT}"/>
</svg>`
}

const menuArt = {
  'gado-gado.svg': bowlArt({ labelText: 'Gado-Gado Kampoeng' }),
  'lontong-sayur.svg': bowlArt({ labelText: 'Lontong Sayur', accent: '#D27C1D' }),
  'nasi-uduk.svg': plateArt({ labelText: 'Nasi Uduk', accent: '#C9A86A' }),
  'mie-goreng.svg': plateArt({ labelText: 'Mie Goreng', accent: '#B0713F' }),
  'sate-ayam.svg': plateArt({ labelText: 'Sate Ayam', accent: '#A35A2E' }),
  'soto-ayam.svg': bowlArt({ labelText: 'Soto Ayam', accent: '#E0A93C' }),
  'es-cendol.svg': drinkArt({ labelText: 'Es Cendol Biru', accent: '#3F76B0' }),
  'es-teh.svg': drinkArt({ labelText: 'Es Teh Manis', accent: '#C08B3C' }),
  'jus-alpukat.svg': drinkArt({ labelText: 'Jus Alpukat', accent: '#7FA254' }),
  'kopi-susu.svg': drinkArt({ labelText: 'Kopi Susu', accent: '#7B5B3A' }),
}

const galleryArt = [
  interiorArt({ labelText: 'Hidangan Pilihan', accent: NAVY }),
  interiorArt({ labelText: 'Sudut Nyaman', accent: '#2D5D94' }),
  interiorArt({ labelText: 'Meja Penuh Cerita', accent: '#254B78' }),
  interiorArt({ labelText: 'Momen Bersama', accent: ACCENT }),
  bowlArt({ labelText: 'Lontong Sayur', accent: '#D27C1D' }),
  interiorArt({ labelText: 'Pojok Biru', accent: '#3F76B0' }),
  interiorArt({ labelText: 'Jam Makan', accent: '#AD6118' }),
  interiorArt({ labelText: 'Senyum Pemilik', accent: LEAF }),
]

const files = [
  ['logo.svg', 'public/images/logo/logo.svg', logoArt()],
  ['hero.svg', 'public/images/hero/hero.svg', plateArt({ w: 1200, h: 1000, labelText: 'Gado-Gado Kampoeng' })],
  ['about.svg', 'public/images/about/about.svg', interiorArt({ w: 1200, h: 1000, labelText: 'Kampoeng Biru' })],
  ...Object.entries(menuArt).map(([name, svg]) => [name, `public/images/menu/${name}`, svg]),
  ...galleryArt.map((svg, i) => [`gallery-${String(i + 1).padStart(2, '0')}.svg`, `public/images/gallery/gallery-${String(i + 1).padStart(2, '0')}.svg`, svg]),
]

for (const [, path, svg] of files) {
  const full = join(root, path)
  mkdirSync(dirname(full), { recursive: true })
  writeFileSync(full, svg, 'utf8')
  console.log(`created ${path}`)
}
console.log('Selesai. Semua placeholder SVG berhasil dibuat.')