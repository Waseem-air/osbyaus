/**
 * SweetAlert Helper - Reusable SweetAlert functions
 * Usage:
 * - SweetAlertHelper.success(message, title)
 * - SweetAlertHelper.error(message, title)
 * - SweetAlertHelper.confirm(message, title, confirmCallback)
 */

class SweetAlertHelper {
    static defaultConfig = {
        background: '#fff',
        customClass: {
            popup: 'custom-swal-popup',
            title: 'custom-swal-title',
            content: 'custom-swal-content',
            confirmButton: 'custom-swal-confirm',
            cancelButton: 'custom-swal-cancel'
        }
    };

    /**
     * Show success alert
     * @param {string} message - Alert message
     * @param {string} title - Alert title (optional)
     * @param {object} config - Additional configuration (optional)
     */
    static success(message, title = 'Success!', config = {}) {
        return Swal.fire({
            ...this.defaultConfig,
            icon: '',
            title: title,
            text: message,
            showConfirmButton: true,
            customClass: {
                ...this.defaultConfig.customClass,
                icon: 'custom-swal-success',
                ...config.customClass
            },
            ...config
        });
    }

    /**
     * Show error alert
     * @param {string} message - Alert message
     * @param {string} title - Alert title (optional)
     * @param {object} config - Additional configuration (optional)
     */
    static error(message, title = 'Error!', config = {}) {
        return Swal.fire({
            ...this.defaultConfig,
            icon: '',
            title: title,
            text: message,
            showConfirmButton: true,
            customClass: {
                ...this.defaultConfig.customClass,
                icon: 'custom-swal-error',
                ...config.customClass
            },
            ...config
        });
    }

    /**
     * Show warning alert
     * @param {string} message - Alert message
     * @param {string} title - Alert title (optional)
     * @param {object} config - Additional configuration (optional)
     */
    static warning(message, title = 'Warning!', config = {}) {
        return Swal.fire({
            ...this.defaultConfig,
            icon: '',
            title: title,
            text: message,
            showConfirmButton: true,
            customClass: {
                ...this.defaultConfig.customClass,
                icon: 'custom-swal-warning',
                ...config.customClass
            },
            ...config
        });
    }

    /**
     * Show info alert
     * @param {string} message - Alert message
     * @param {string} title - Alert title (optional)
     * @param {object} config - Additional configuration (optional)
     */
    static info(message, title = 'Information', config = {}) {
        return Swal.fire({
            ...this.defaultConfig,
            icon: '',
            title: title,
            text: message,
            showConfirmButton: true,
            customClass: {
                ...this.defaultConfig.customClass,
                icon: 'custom-swal-info',
                ...config.customClass
            },
            ...config
        });
    }

    /**
     * Show confirmation dialog
     * @param {string} message - Confirmation message
     * @param {string} title - Dialog title (optional)
     * @param {function} confirmCallback - Function to call on confirmation
     * @param {object} config - Additional configuration (optional)
     */
    static confirm(message, title = 'Are you sure?', confirmCallback = null, config = {}) {
        return Swal.fire({
            ...this.defaultConfig,
            icon: 'question',
            title: title,
            text: message,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel',
            reverseButtons: true,
            customClass: {
                ...this.defaultConfig.customClass,
                ...config.customClass
            },
            ...config
        }).then((result) => {
            if (result.isConfirmed && confirmCallback) {
                confirmCallback();
            }
            return result;
        });
    }

    /**
     * Show success alert without button (auto-close)
     * @param {string} message - Alert message
     * @param {string} title - Alert title (optional)
     * @param {number} timer - Auto-close timer in ms (default: 1600)
     */
    static successAutoClose(message, title = 'Success!', timer = 1600) {
        return Swal.fire({
            ...this.defaultConfig,
            icon: '',
            title: title,
            text: message,
            showConfirmButton: false,
            timer: timer,
            customClass: {
                ...this.defaultConfig.customClass,
                icon: 'custom-swal-success'
            }
        });
    }

    /**
     * Show loading alert
     * @param {string} message - Loading message
     * @param {string} title - Loading title (optional)
     */
    static loading(message = 'Please wait...', title = '') {
        return Swal.fire({
            ...this.defaultConfig,
            title: title,
            text: message,
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });
    }

    /**
     * Close currently open SweetAlert
     */
    static close() {
        Swal.close();
    }

    /**
     * Show alert with HTML content
     * @param {string} html - HTML content
     * @param {string} title - Alert title
     * @param {string} icon - Alert icon (success, error, warning, info, question)
     */
    static html(html, title = '', icon = null) {
        const config = {
            ...this.defaultConfig,
            title: title,
            html: html,
            showConfirmButton: true
        };

        if (icon) {
            config.icon = icon;
            config.customClass = {
                ...this.defaultConfig.customClass,
                icon: `custom-swal-${icon}`
            };
        }

        return Swal.fire(config);
    }
}

// Make it available globally
window.SweetAlertHelper = SweetAlertHelper;
