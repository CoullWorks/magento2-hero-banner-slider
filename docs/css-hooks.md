# CSS hooks for Hero Banner Slider

## Classes

| Class | Where |
|---|---|
| `.hero` | The wrapper of a hero banner |
| `.slider` | The wrapper of a slider |
| `.banner` | The banner inside a hero |
| `.slide` | One slide in a slider |
| `.overlay` and `.overlay .inner` | The overlay layer and its content box |
| `.tabs` and `.tab` | The tabs strip and one tab (a `h4` with the banner name) |
| `.full-width`, `.full-height` | Added by Full Width and Full Page Height |
| `.is-parallax` and `.img-parallax` | Added by Parallax, on the wrapper and the `<picture>` |
| `.slick-*` | Slick's own classes |

Each placement also gets a unique id, `cw-slider-` followed by eight characters, and the tabs strip the same id with `-tabs`. Add your own through **CSS Classes** in Page Builder. Do not rely on the id.

## No CSS variables

The module defines no CSS custom properties. Its LESS reads your theme's variables, such as `@color-gray-middle4`, `@color-white` and the `@button-primary__*` set, so it follows your theme colours.

## Slick

Slick 1.9.0 (MIT) is bundled in `view/frontend/web/js/vendor/` with its LESS. There is no CDN request. The arrow font and loader image ship in `view/frontend/web/`.
{pend('arrow font and loader asset paths after the fix. Verify the browser makes no 404 requests for slick fonts or ajax-loader.gif')}
