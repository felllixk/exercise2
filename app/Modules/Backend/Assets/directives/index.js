import { bind } from "lodash";

export default function (app) {
    app.directive('click-outside', { // blur or focus out instead this directive?
        mounted(el, binding, vnode) {
            el.clickOutsideEvent = function (event) {
                if (!(el === event.target || el.contains(event.target))) {
                    binding.value(event, el);
                }
            };

            setTimeout(() => {
                document.body.addEventListener('click', el.clickOutsideEvent);
            }, 90);
        },
        unmounted(el) {
            document.body.removeEventListener('click', el.clickOutsideEvent);
        }
    });
}
