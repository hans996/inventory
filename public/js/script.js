// toastr
$(document).ready(function () {
    toastr.options = {
        progressBar: true,
        positionClass: "toast-top-right",
    };
});

window.addEventListener("success", (event) => {
    toastr.success(event.detail.message);
});
window.addEventListener("warning", (event) => {
    toastr.warning(event.detail.message);
});
window.addEventListener("error", (event) => {
    toastr.error(event.detail.message);
});

// modal hide
window.addEventListener("close-modal", (event) => {
    $("#backDropModalS").modal("hide");
});

// scroll to view
function scrollToElement(elementId) {
    const element = document.getElementById(elementId);
    if (element) {
        element.scrollIntoView({ behavior: "smooth" });
    }
}

document.addEventListener("livewire:load", function () {
    Livewire.hook("message.processed", (message, component) => {
        if (component.fingerprint.name === "submission-update") {
            scrollToElement("submission");
        }

        if (component.fingerprint.name === "user-update") {
            scrollToElement("user");
        }

        if (component.fingerprint.name === "position-update") {
            scrollToElement("position");
        }

        if (component.fingerprint.name === "suplier-update") {
            scrollToElement("suplier");
        }
    });

    document.querySelectorAll(".scroll-submission").forEach((button) => {
        button.addEventListener("click", function () {
            scrollToElement("submission");
        });
    });

    document.querySelectorAll(".scroll-user").forEach((button) => {
        button.addEventListener("click", function () {
            scrollToElement("user");
        });
    });

    document.querySelectorAll(".scroll-position").forEach((button) => {
        button.addEventListener("click", function () {
            scrollToElement("position");
        });
    });

    document.querySelectorAll(".scroll-suplier").forEach((button) => {
        button.addEventListener("click", function () {
            scrollToElement("suplier");
        });
    });
});
