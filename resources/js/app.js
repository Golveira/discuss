import "./bootstrap";
import getCaretCoordinates from "textarea-caret";
import {
    Alpine,
    Livewire,
} from "../../vendor/livewire/livewire/dist/livewire.esm";
import ToastComponent from "../../vendor/usernotnull/tall-toasts/resources/js/tall-toasts";

window.getCaretCoordinates = getCaretCoordinates;

Alpine.plugin(ToastComponent);

Livewire.start();
