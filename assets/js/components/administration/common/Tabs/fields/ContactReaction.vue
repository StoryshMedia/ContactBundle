<template>
  <div>
    <form 
      class="space-y-4"
      @submit.prevent="sendReaction"
    >
      <div class="grid md:grid-cols-2 gap-5">
        <div>
          <h5
            class="font-semibold text-lg pb-2"
          >
            {{ $t('SUBJECT') }}
          </h5>
          <input
            type="text"
            :placeholder="$t('SUBJECT')"
            :value="data.subject"
            :model="data.subject"
            class="form-input"
            @change="setSubject($event)"
          >
        </div>
        <div>
          <h5
            class="font-semibold text-lg pb-2"
          >
            {{ $t('MESSAGE') }}
          </h5>
          <div class="minimized--editor">
            <QuillEditor
              v-if="editAllowed"
              style="height: 13rem"
              :content="data.message"
              :content-type="'html'"
              :theme="'snow'"
              @update:content="setContent($event)"
            />
          </div>
        </div>
      </div>
      
      <div class="flex justify-end mt-5">
        <button
          type="submit"
          class="btn btn-success"
        >
          {{ $t('SEND') }}
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import ApiService from '@SmugAdministration/js/services/api/api.service';

export default {
  name: "ContactReaction",
  components: {
  },
  props: {
    editAllowed:{
      type: Boolean,
      required: true
    },
    fieldValue:{
      type: String,
      required: false,
      default: ''
    },
    fieldConfig:{
      type: Object,
      required: false,
      default: () => ({})
    },
    fieldPlaceholder:{
      type: String,
      required: false,
      default: 'TEXT_PLACEHOLDER'
    }
  },
  data() {
    return {
      data: {
        subject: '',
        message: ''
      }
    };
  },
  mounted() {
    const identifier = this.fieldConfig.identifier ?? 'contact';

    this.data[identifier] = {
      id: this.fieldConfig.id
    };
  },
  methods: {
    setContent(content) {
      this.data.message = content;
    },
    setSubject(event) {
      this.data.subject = event.target.value;
    },
    sendReaction() {
      ApiService.post(this.fieldConfig.call, this.data);
    }
  }
}
</script>