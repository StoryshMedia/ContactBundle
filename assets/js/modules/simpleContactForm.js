import SimpleContactForm from '../components/elements/plugin/form/SimpleContactForm.vue';
import VueModule from '../../../../FrontendBundle/assets/js/modules/vue-module.js';

VueModule.observeAndMount({
  identifier: 'simple-contact-form',
  component: SimpleContactForm,
  options: {useStore: true, provideDataset: true, identifier: 'simple-contact-form'}
}).then(({ app, section }) => {
  console.log('Vue erfolgreich gemountet auf:', section);
}).catch(console.error);