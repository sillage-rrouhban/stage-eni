<template>
  <div class="column account__studies">
    <app-loader v-if="showLoader"/>
    <div class="columns">
      <div class="field is-one-third column">
        <label class="label">{{ $t("account.studies.resume_title") }}</label>
        <div class="control">
          <input class="input" type="text" v-model="currentResumeTitle">
        </div>
      </div>
      <div class="field column is-one-third">
        <label class="label">{{ $t("account.studies.resume") }}</label>
        <input class="input" type="file" ref="cvFile">
      </div>
    </div>
    <div class="columns">
      <div class="column field is-one-third">
        <label class="label">{{ $t("account.studies.domain") }}</label>
        <div class="select is-multiple">
          <select size="3" v-if="domains && domains.length > 0">
            <option :value="domain.id" v-for="domain of domains" :key="domain.id">
              {{ domain.label }}
            </option>
          </select>
        </div>
      </div>
      <div class="field column is-one-third">
        <label class="label">{{ $t("account.studies.level") }}</label>
        <div class="select is-multiple">
          <select size="3" v-if="levels && levels.length > 0">
            <option :value="level.id" v-for="level of levels" :key="level.id">
              {{ level.label }}
            </option>
          </select>
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="field column is-one-third">
        <label class="label">{{ $t("account.studies.professional_designation") }}</label>
        <div class="control">
          <input class="input" type="text">
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="field is-one-third column">
        <button class="button" type="button" @click="submitForm">{{ $t("account.studies.update") }}</button>
      </div>
    </div>
    <div class="columns">
      <div class="column is-two-thirds">
        <table class="table is-striped is-fullwidth is-bordered">
          <thead>
          <tr>
            <th>
              titre cv
            </th>
            <th>

              fichier
            </th>
            <th>
              mise en ligne
            </th>
            <th>
              actions
            </th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="cv of myDetails.cvs" v-if="myDetails">
            <td>
              <template v-if="cv.cvTitle">
                {{cv.cvTitle.title.label}}
              </template>
              <template v-else>
                N/A
              </template>
            </td>
            <td>{{cv.filename}}</td>
            <td>{{cv.uploadedAt}}</td>
            <td> <img :src="deleteIcon" alt="" @click="emitModalClick(1)"> <img :src="editIcon" alt=""></td>
            <app-generic-modal v-if="typeModal === 1 && showModal">
              <template v-slot:title>
                {{$t('account.studies.delete_title')}}
              </template>
              <template v-slot:body>
                {{ $t('account.studies.delete_confirmation') }}
              </template>
              <template v-slot:buttons>
                <button class="button is-success" @click="deleteFile(cv.id)">{{$t('modal.delete')}}</button>
                <button class="button" @click="emitModalClick(0)"> {{$t('modal.cancel')}}</button>
              </template>
            </app-generic-modal>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import AppLoader from "@/components/AppLoader";
import AppGenericModal from "@/components/AppGenericModal";

const config = {
  headers: {
    'Content-Type': 'application/json;'
  }
};
export default {
  name: "AppAccountStudies",
  components: {
    AppLoader,
    AppGenericModal
  },
  data() {
    return {
      professionalDesignation: '',
      toggleDropdown: false,
      currentResumeTitle : '',
      cvFile: '',
      showLoader: false,
      deleteIcon: require('/assets/images/account/delete.svg'),
      editIcon: require('/assets/images/account/pencil.svg'),
      file: require('/assets/images/account/file.svg'),
      showModal: false,
      typeModal: 0,
    }
  },
  computed: {
    ...mapGetters({
      domains: 'domains/domains',
      levels: 'levels/levels',
      error: 'cvs/error',
      myDetails : 'users/user',
      cv : 'cvs/cv',
      title : 'titles/title',
    }),
  },
  created() {
    this.emitter.on('toggle-modal', (value) => {
      this.showModal = value;
    })
  },
  async mounted() {
    await this.$store.dispatch('domains/fetchDomains')
    await this.$store.dispatch('levels/fetchLevels')
    await this.$store.dispatch('users/fetchUser',localStorage.getItem('user'))
    console.log(this.myDetails)
  },
  methods: {
    handleFileUpload() {
      this.cvFile = this.$refs.cvFile.files[0];
    },
    async submitForm() {
      this.showLoader = true;
      this.handleFileUpload();
      let formData = new FormData();
      const userIri = localStorage.getItem('user');
      const userId = userIri.substring(userIri.lastIndexOf('/') + 1);
      formData.append('id', '0');
      formData.append('user', userId);
      formData.append('file', this.cvFile);
      await this.$store.dispatch('cvs/createCv', formData);
      if(this.currentResumeTitle.length > 0) {
        let titlePayload = {
          label : this.currentResumeTitle
        }
        await this.$store.dispatch('titles/createTitle', titlePayload);
        let cvTitlePayload = {
          cv : 'api/cvs/' + this.cv.id,
          title : 'api/titles/' + this.title.id,
        }
        await this.$store.dispatch('titles/createLinkCVTitle', cvTitlePayload);
      }
      await this.$store.dispatch('users/fetchUser', localStorage.getItem('user'))
      this.showLoader = false;
    },
    emitModalClick(id){
      this.typeModal = id;
      this.emitter.emit('toggle-modal', !this.showModal);
    },
    async deleteFile(id){
      let payload = '/api/cvs/' + id;
      await this.$store.dispatch('cvs/deleteCv',payload);
      await this.$store.dispatch('users/fetchUser', localStorage.getItem('user'));
      this.showModal = false;
    }

  }
}
</script>

<style scoped lang="scss">
.account {

  &__studies {
    img{
      cursor: pointer;
      width: 1.8rem;
      &+img{
        margin-left: .5rem;
      }
    }
    .select {
      width: 100%;

      select {
        height: 8rem;
        width: 100%;
      }
    }
  }
}
</style>
