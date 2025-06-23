<template>
  <form @submit.prevent="submitForm">
    <div
      v-if="showConfirmation === false"
      class="flex flex-wrap justify-center"
    >
      <div class="w-full bg-transparent">
        <div class="m-auto">
          <div
            class="relative flex flex-col min-w-0 break-words w-full mb-6 bg-transparent text-dark"
          >
            <div
              class="flex-auto p-5 lg:p-10"
            >
              <div class="relative w-full my-8 flex">
                <div class="relative w-full md:w-1/2 flex-auto pr-1">
                  <label
                    class="block text-xs text-left font-bold mb-2"
                    for="first-name"
                  >{{ $t('FIRST_NAME') }}</label><input
                    id="first-name"
                    v-model="form.firstName"
                    type="text"
                    class="w-full input rounded-3xl shadow-xl border-gray"
                    :placeholder="$t('FIRST_NAME')"
                    :disabled="isLoading"
                    style="transition: all 0.15s ease 0s;"
                  >
                </div>
                <div class="relative w-full md:w-1/2 flex-auto pl-1">
                  <label
                    class="block text-xs text-left font-bold mb-2"
                    for="last-name"
                  >{{ $t('LAST_NAME') }}</label><input
                    id="last-name"
                    v-model="form.lastName"
                    type="text"
                    class="w-full input rounded-3xl shadow-xl border-gray"
                    :placeholder="$t('LAST_NAME')"
                    :disabled="isLoading"
                    style="transition: all 0.15s ease 0s;"
                  >
                </div>
              </div>
              <div class="relative w-full my-8">
                <label
                  class="block text-xs text-left font-bold mb-2"
                  for="HomeContactEmail"
                >{{ $t('EMAIL') }}</label><input
                  id="HomeContactEmail"
                  v-model="form.email"
                  type="email"
                  class="w-full input rounded-3xl shadow-xl border-gray"
                  :placeholder="$t('EMAIL')"
                  :disabled="isLoading"
                  style="transition: all 0.15s ease 0s;"
                >
                <input
                  v-model="form.fax"
                  type="hidden"
                  style="transition: all 0.15s ease 0s;"
                >
              </div>
              <div class="relative w-full my-8">
                <label
                  class="block text-xs text-left font-bold mb-2"
                  for="message"
                >{{ $t('MESSAGE') }}</label><textarea
                  id="message"
                  v-model="form.message"
                  rows="4"
                  cols="80"
                  class="w-full input rounded-3xl shadow-xl p-4 border border-gray"
                  :placeholder="$t('MESSAGE_PLACEHOLDER')"
                  :disabled="isLoading"
                />
              </div>
              <div class="text-center mt-6">
                <button
                  class="outline-link outline-link-primary loading-spinner-outline-link"
                  type="submit"
                  style="transition: all 0.15s ease 0s;"
                >
                  <span v-if="isLoading === true">
                    <svg
                      role="status"
                      class="inline w-4 h-4 text-primary animate-spin"
                      viewBox="0 0 100 101"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="#cd9144"
                      />
                      <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="#faf4ec"
                      />
                    </svg>
                  </span>
                  <span v-else>
                    {{ $t('SEND_FORM') }}
                  </span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <app-form-confirmation
      v-else
      :text="$t('CONTACT_CONFIRMATION_TEXT')"
      :text-color="'text-white'"
      :is-error="isError"
      :padding-bottom="'pb-5'"
    />
  </form>
</template>

<script>
import ApiService from '@SmugAdministration/js/services/api/api.service';
import { defineAsyncComponent } from "vue";
const AppFormConfirmation = defineAsyncComponent(() =>
  import("./FormConfirmation" /* webpackChunkName: "form-confirmation" */)
);

export default {
  name: "SimpleContactForm",
  components: {
    AppFormConfirmation
  },
  inject: ['dataset'],
  data(){
    return{
      endpoint: '',
      showConfirmation: false,
      isLoading: false,
      isError: false,
      form: {
        firstName: '',
        lastName: '',
        email: '',
        fax: '',
        message: ''
      }
    }
  },
  computed: {
    styles() {
      return {
        'background-image': `url("${this.image}")`,
        'background-repeat': 'no-repeat',
        'background-position': 'center',
        'background-size': 'cover'
      }
    }
  },
  mounted() {
    this.setProps();
  },
  methods: {
    setProps() {
      const props = JSON.parse(this.dataset.props);
      this.endpoint = (props.apiEndpoint) ? props.apiEndpoint : '';
    },
    submitForm(){
      this.isLoading = true;
      if (this.form.fax === '') {
        if (this.detailName !== '') {
          this.form.detailName = this.detailName;
        }
        ApiService.post(this.endpoint, this.form, false).then(result => {
          this.showConfirmation = true;
          this.isLoading = false;
        });
      } else {
        this.isLoading = true;
      }
    }
  }
}
</script>
