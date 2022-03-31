<template>
  <div class="column account__studies">
    <div class="columns">
      <div class="field is-one-third column">
        <label class="label">{{ $t("account.studies.resume_title") }}</label>
        <div class="control">
          <input class="input" type="text" v-model="resumeTitle">
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
      <div class="column is-full">
      <table class="table is-striped is-fullwidth">
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
        </tr>
        </thead>
        <tbody>
        <tr>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        </tbody>
      </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import {mapGetters, useStore} from "vuex";
import {computed} from "vue";

const config = {
  headers: {
    'Content-Type': 'application/json;'
  }
};
export default {
  name: "AppAccountStudies",
  data() {
    return {
      professionalDesignation: '',
      toggleDropdown: false,
      resumeTitle: '',
      cvFile: '',
    }
  },

  computed: {
    ...mapGetters({
      domains: 'domains/domains',
      levels: 'levels/levels',
      error: 'cvs/error',
    }),
  },

  async mounted() {
    await this.$store.dispatch('domains/fetchDomains')
    await this.$store.dispatch('levels/fetchLevels')
  },
  methods: {
    handleFileUpload() {
      this.cvFile = this.$refs.cvFile.files[0];
    },
    async submitForm() {
      this.handleFileUpload();
      let formData = new FormData();
      const userIri = localStorage.getItem('user');
      const userId = userIri.substring(userIri.lastIndexOf('/') + 1);
      formData.append('id', '0');
      formData.append('user', userId);
      formData.append('file', this.cvFile);
      await this.$store.dispatch('cvs/createCv', formData);
    },

  }
}
</script>

<style scoped lang="scss">
.account {
  &__studies {
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
