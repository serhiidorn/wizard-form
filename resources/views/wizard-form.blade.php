<x-app-layout>
    @include('components.toast')

    <div class="min-h-screen flex items-center justify-center p-4">
        <div
            x-data="wizard()"
            x-init="init()"
            class="w-full max-w-2xl bg-white rounded-lg shadow-md overflow-hidden"
        >
            <!-- Progress Steps -->
            <div class="flex justify-between px-6 pt-6 pb-2 border-b">
                <template x-for="(step, index) in steps" :key="index">
                    <div class="flex flex-col items-center">
                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center font-bold transition-all"
                            :class="{
                            'step-active': currentStep === index + 1,
                            'step-completed': currentStep > index + 1,
                            'step-inactive': currentStep < index + 1
                        }"
                        >
                            <span x-text="index + 1"></span>
                        </div>
                        <span
                            class="text-xs mt-2 font-medium"
                            :class="{
                            'text-blue-600': currentStep === index + 1,
                            'text-green-500': currentStep > index + 1,
                            'text-gray-500': currentStep < index + 1
                        }"
                            x-text="step"
                        ></span>
                    </div>
                </template>
            </div>

            <!-- Form Steps -->
            <div class="p-6 min-h-[500px] relative">
                <!-- Step 1: Personal Information -->
                <div x-show="currentStep === 1" x-transition x-cloak class="absolute inset-0 p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Personal Information</h2>

                    <div class="space-y-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">
                                First Name
                            </label>
                            <input
                                type="text"
                                id="first_name"
                                x-model="formData.first_name"
                                @blur="validateField('first_name')"
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': errors.first_name }"
                            >
                            <p x-show="errors.first_name" x-text="errors.first_name" class="mt-1 text-sm text-red-600"></p>
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">
                                Last Name
                            </label>
                            <input
                                type="text"
                                id="last_name"
                                x-model="formData.last_name"
                                @blur="validateField('last_name')"
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': errors.last_name }"
                            >
                            <p x-show="errors.last_name" x-text="errors.last_name" class="mt-1 text-sm text-red-600"></p>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input
                                type="tel"
                                id="phone"
                                x-model="formData.phone"
                                @blur="validateField('phone')"
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': errors.phone }"
                            >
                            <p x-show="errors.phone" x-text="errors.phone" class="mt-1 text-sm text-red-600"></p>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input
                                type="email"
                                id="email"
                                x-model="formData.email"
                                @blur="validateField('email')"
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': errors.email }"
                            >
                            <p x-show="errors.email" x-text="errors.email" class="mt-1 text-sm text-red-600"></p>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Company Information -->
                <div x-show="currentStep === 2" x-transition x-cloak class="absolute inset-0 p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Company Information</h2>

                    <div class="space-y-4">
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">
                                Company Name
                            </label>
                            <input
                                type="text"
                                id="company_name"
                                x-model="formData.company_name"
                                @blur="validateField('company_name')"
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': errors.company_name }"
                            >
                            <p x-show="errors.company_name" x-text="errors.company_name" class="mt-1 text-sm text-red-600"></p>
                        </div>

                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                            <select
                                id="country"
                                x-model="formData.country_code"
                                @blur="validateField('country_code')"
                                @change="validateField('country_code')"
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': errors.country_code }"
                            >
                                <option value="" disabled>Select Country</option>
                                <option value="UA">Ukraine</option>
                                <option value="US">United States</option>
                                <option value="UK">United Kingdom</option>
                                <option value="CA">Canada</option>
                                <option value="AU">Australia</option>
                                <option value="DE">Germany</option>
                            </select>
                            <p x-show="errors.country_code" x-text="errors.country_code" class="mt-1 text-sm text-red-600"></p>
                        </div>

                        <div>
                            <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">Company Logo</label>
                            <div class="mt-1 flex items-center">
                            <span class="inline-block min-w-24 min-h-24 w-24 h-24 rounded-full overflow-hidden bg-gray-100">
                                <template x-if="formData.logo_preview">
                                    <img :src="formData.logo_preview" class="h-full w-full object-cover">
                                </template>
                                <template x-if="!formData.logo_preview">
                                    <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </template>
                            </span>
                                <input
                                    type="file"
                                    id="logo"
                                    @change="handleLogoUpload"
                                    class="ml-5 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100"
                                >
                            </div>
                            <p x-show="errors.logo" x-text="errors.logo" class="mt-1 text-sm text-red-600"></p>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Success Message -->
                <div x-show="currentStep === 3" x-transition x-cloak class="absolute inset-0 p-6">
                    <div class="text-center py-8">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h2 class="mt-3 text-xl font-bold text-gray-800">Registration Successful!</h2>
                        <p class="mt-2 text-gray-600">
                            Thank you for submitting your information. We'll get back to you soon.
                        </p>
                        <div class="mt-6 bg-gray-50 p-4 rounded-md text-left">
                            <h3 class="font-medium text-gray-800">Submitted Information:</h3>
                            <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-2 text-sm text-gray-600">
                                <p><span class="font-medium">Name:</span>
                                    <span x-text="formData.first_name + ' ' + formData.last_name"></span></p>
                                <p><span class="font-medium">Email:</span> <span x-text="formData.email"></span></p>
                                <p><span class="font-medium">Phone:</span> <span x-text="formData.phone"></span></p>
                                <p><span class="font-medium">Company:</span>
                                    <span x-text="formData.company_name"></span>
                                </p>
                                <p><span class="font-medium">Country:</span>
                                    <span x-text="getCountryName(formData.country_code)"></span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="isSubmitting" x-cloak class="absolute inset-0 bg-white bg-opacity-50 flex items-center justify-center">
                    <div class="inline-flex items-center">
                        <svg class="animate-spin h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="ml-2 text-gray-700">Processing your request...</span>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="px-6 py-4 bg-gray-50 border-t flex justify-between">
                <button
                    x-show="currentStep > 1 && currentStep < 3"
                    @click="previousStep()"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500"
                >
                    Back
                </button>
                <div x-show="currentStep < 3" class="ml-auto">
                    <button
                        x-show="currentStep < 2"
                        @click="nextStep()"
                        :disabled="!validateCurrentStep()"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        Next
                    </button>
                    <button
                        x-show="currentStep === 2"
                        @click="submitForm()"
                        :disabled="!isStepValid(currentStep) || isSubmitting"
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center"
                    >
                        <svg x-show="isSubmitting" x-cloak class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span x-text="isSubmitting ? 'Processing...' : 'Submit'"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('wizard', () => ({
                steps: ['Personal', 'Company', 'Complete'],
                currentStep: 1,
                isSubmitting: false,

                formData: {
                    first_name: '',
                    last_name: '',
                    phone: '',
                    email: '',
                    company_name: '',
                    country_code: '',
                    logo: null,
                    logo_preview: null
                },

                touchedFields: {
                    first_name: false,
                    last_name: false,
                    phone: false,
                    email: false,
                    company_name: false,
                    country_code: false,
                    logo: false
                },

                errors: {
                    first_name: '',
                    last_name: '',
                    phone: '',
                    email: '',
                    company_name: '',
                    country_code: '',
                    logo: '',
                    general: ''
                },

                countryNames: {
                    'US': 'United States',
                    'UK': 'United Kingdom',
                    'CA': 'Canada',
                    'AU': 'Australia',
                    'DE': 'Germany',
                    'UA': 'Ukraine'
                },

                init() {
                    this.loadSavedData();
                },

                loadSavedData() {
                    try {
                        const savedData = localStorage.getItem('wizardFormData');
                        if (savedData) {
                            const parsed = JSON.parse(savedData);
                            this.formData = {...this.formData, ...parsed};
                            this.formData.logo = null;
                            this.formData.logo_preview = null;
                        }
                    } catch (error) {
                        console.warn('Error loading saved data:', error);
                        localStorage.removeItem('wizardFormData');
                    }
                },

                nextStep() {
                    this.clearGeneralError();
                    if (this.validateCurrentStep()) {
                        this.currentStep++;
                        this.saveFormData();
                    }
                },

                previousStep() {
                    if (this.currentStep > 1) {
                        this.currentStep--;
                        this.clearGeneralError();
                    }
                },

                validateCurrentStep() {
                    return this.isStepValid(this.currentStep, false);
                },

                isStepValid(step, showErrors = true) {
                    let isValid = true;

                    switch (step) {
                        case 1:
                            if (!this.formData.first_name.trim()) {
                                if (showErrors && this.touchedFields.first_name) this.errors.first_name = 'First name is required';
                                isValid = false;
                            }
                            if (!this.formData.last_name.trim()) {
                                if (showErrors && this.touchedFields.last_name) this.errors.last_name = 'Last name is required';
                                isValid = false;
                            }
                            if (!this.validateEmail(this.formData.email)) {
                                if (showErrors && this.touchedFields.email) this.errors.email = 'Please enter a valid email address';
                                isValid = false;
                            }
                            if (!this.validatePhone(this.formData.phone)) {
                                if (showErrors && this.touchedFields.phone) this.errors.phone = 'Please enter a valid phone number';
                                isValid = false;
                            }
                            break;

                        case 2:
                            if (!this.formData.company_name.trim()) {
                                if (showErrors && this.touchedFields.company_name) this.errors.company_name = 'Company name is required';
                                isValid = false;
                            }
                            if (!this.formData.country_code) {
                                if (showErrors && this.touchedFields.country_code) this.errors.country_code = 'Please select a country';
                                isValid = false;
                            }
                            break;
                    }

                    return isValid;
                },

                validateField(field) {
                    this.touchedFields[field] = true;
                    this.errors[field] = '';

                    switch (field) {
                        case 'first_name':
                            if (!this.formData.first_name.trim()) {
                                this.errors.first_name = 'First name is required';
                            }
                            break;
                        case 'last_name':
                            if (!this.formData.last_name.trim()) {
                                this.errors.last_name = 'Last name is required';
                            }
                            break;
                        case 'phone':
                            if (!this.validatePhone(this.formData.phone)) {
                                this.errors.phone = 'Please enter a valid phone number';
                            }
                            break;
                        case 'email':
                            if (!this.validateEmail(this.formData.email)) {
                                this.errors.email = 'Please enter a valid email address';
                            }
                            break;
                        case 'company_name':
                            if (!this.formData.company_name.trim()) {
                                this.errors.company_name = 'Company name is required';
                            }
                            break;
                        case 'country_code':
                            if (!this.formData.country_code) {
                                this.errors.country_code = 'Please select a country';
                            }
                            break;
                    }
                },

                validateEmail(email) {
                    if (!email) return false;
                    const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
                    return emailRegex.test(email.trim());
                },

                validatePhone(phone) {
                    if (!phone) return false;
                    const cleanPhone = phone.replace(/[^\d+]/g, '');

                    const phoneRegex = /^\+?[1-9]\d{6,14}$/;
                    const isValid = phoneRegex.test(cleanPhone);

                    return isValid && cleanPhone.length >= 7 && cleanPhone.length <= 15;
                },

                handleLogoUpload(event) {
                    const file = event.target.files[0];
                    this.errors.logo = '';

                    if (!file) {
                        this.formData.logo = null;
                        this.formData.logo_preview = null;
                        return;
                    }

                    const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
                    if (!validTypes.includes(file.type.toLowerCase())) {
                        this.errors.logo = 'Please upload a valid image (JPEG, PNG, WebP)';
                        event.target.value = '';
                        return;
                    }

                    const maxSize = 5 * 1024 * 1024;
                    if (file.size > maxSize) {
                        this.errors.logo = 'Image must be less than 5MB';
                        event.target.value = '';
                        return;
                    }

                    this.formData.logo = file;

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.formData.logo_preview = e.target.result;
                    };
                    reader.onerror = () => {
                        this.errors.logo = 'Error reading file';
                        this.formData.logo = null;
                        this.formData.logo_preview = null;
                    };
                    reader.readAsDataURL(file);
                },

                getCountryName(code) {
                    return this.countryNames[code] || code;
                },

                saveFormData() {
                    try {
                        const dataToSave = {...this.formData};
                        delete dataToSave.logo;
                        delete dataToSave.logo_preview;

                        localStorage.setItem('wizardFormData', JSON.stringify(dataToSave));
                    } catch (error) {
                        console.warn('Error saving form data:', error);
                    }
                },

                clearFieldErrors() {
                    Object.keys(this.errors).forEach(key => {
                        if (key !== 'general') {
                            this.errors[key] = '';
                        }
                    });
                },

                clearGeneralError() {
                    this.errors.general = '';
                },

                clearAllErrors() {
                    Object.keys(this.errors).forEach(key => {
                        this.errors[key] = '';
                    });
                },

                handleServerErrors(errors, step = null) {
                    this.clearAllErrors();

                    if (step && step !== this.currentStep) {
                        this.currentStep = step;
                    }

                    Object.keys(errors).forEach(field => {
                        if (this.errors.hasOwnProperty(field)) {
                            this.errors[field] = Array.isArray(errors[field])
                                ? errors[field][0]
                                : errors[field];
                        } else {
                            if (!this.errors.general) {
                                this.errors.general = '';
                            }
                            const errorMessage = Array.isArray(errors[field])
                                ? errors[field][0]
                                : errors[field];
                            this.errors.general += (this.errors.general ? '; ' : '') + errorMessage;
                        }
                    });
                },

                async submitForm() {
                    if (!this.validateCurrentStep() || this.isSubmitting) {
                        return;
                    }

                    this.isSubmitting = true;
                    this.clearAllErrors();

                    try {
                        const formData = new FormData();

                        Object.keys(this.formData).forEach(key => {
                            if (key === 'logo' && this.formData.logo) {
                                formData.append('logo', this.formData.logo);
                            } else if (key === 'phone' && this.formData.phone) {
                                const cleanPhone = this.formData.phone.replace(/[^\d+]/g, '');
                                formData.append('phone', cleanPhone);
                            } else if (key !== 'logo' && key !== 'logo_preview') {
                                formData.append(key, this.formData[key]);
                            }
                        });

                        await axios.post('/customers', formData, {
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                            }
                        });

                        this.currentStep = 3;
                        this.clearSavedData();

                    } catch
                        (error) {
                        if (error.response && error.response.status === 422) {
                            if (error.response.data.errors) {
                                const step1Fields = ['first_name', 'last_name', 'phone', 'email'];
                                const step2Fields = ['company_name', 'country_code', 'logo'];

                                const hasStep1Errors = Object.keys(error.response.data.errors).some(field =>
                                    step1Fields.includes(field)
                                );
                                const hasStep2Errors = Object.keys(error.response.data.errors).some(field =>
                                    step2Fields.includes(field)
                                );

                                let targetStep = this.currentStep;
                                if (hasStep1Errors) {
                                    targetStep = 1;
                                } else if (hasStep2Errors) {
                                    targetStep = 2;
                                }

                                this.handleServerErrors(error.response.data.errors, targetStep);
                            } else {
                                const errorMsg = error.response.data.message || 'Validation error occurred';
                                this.errors.general = errorMsg;
                                window.showToast(errorMsg, 'error');
                            }
                        } else if (error.response) {
                            const errorMsg = error.response.data.message || `Server error: ${error.response.status}`;
                            this.errors.general = errorMsg;
                            window.showToast(errorMsg, 'error');
                        } else if (error.request) {
                            const errorMsg = 'Network error. Please check your connection and try again.';
                            this.errors.general = errorMsg;
                            window.showToast(errorMsg, 'error');
                        } else {
                            const errorMsg = 'An unexpected error occurred. Please try again.';
                            this.errors.general = errorMsg;
                            window.showToast(errorMsg, 'error');
                        }
                    } finally {
                        this.isSubmitting = false;
                    }
                },

                clearSavedData() {
                    try {
                        localStorage.removeItem('wizardFormData');
                    } catch (error) {
                        console.warn('Error clearing saved data:', error);
                    }
                }
            }));
        });
    </script>
</x-app-layout>