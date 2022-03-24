<template>
  <div class="column account__studies">
    <div class="columns">
      <div class="field is-one-third column">

        <label class="label">{{ $t("account.studies.resume_title") }}</label>
        <div class="control">
          <input class="input" type="text" placeholder="">
        </div>
      </div>
      <div class="field column is-one-third">
        <label class="label">{{ $t("account.studies.resume") }}</label>
        <input class="input" type="file">
      </div>
    </div>
    <div class="columns">
      <div class="column field is-one-third">
        <label class="label">{{ $t("account.studies.domain") }}</label>
        <div class="select is-multiple">
          <select  size="3" v-if="domains && domains.length > 0">
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
        <button class="button" type="button" @click="">{{ $t("account.studies.update") }}</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import {useStore} from "vuex";
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
    }
  },

  setup(){
    const store = useStore()
    const domains = computed(()=> store.state.domains.domains)
    const domainsGetter = computed(()=> store.getters['domains/domains'])
    const levels =computed(()=> store.state.levels.levels)
    const levelsGetter = computed(()=> store.getters['levels/levels'])
    store.dispatch('domains/fetchDomains')
    store.dispatch('levels/fetchLevels')
    return{
      domains,
      domainsGetter,
      levels,
      levelsGetter,
    }
  },

  mounted() {
    this.fetchLevels();
  },
  methods: {

    levelsApiGet() {
      return axios.get('/api/levels', config)
    },

    async fetchLevels() {
      let response = await this.levelsApiGet();
      this.levels = response.data;
    },

  }
}
</script>

<style scoped lang="scss">
.account{
  &__studies{
    .select{
      width: 100%;
      select{
        height: 8rem;
        width: 100%;
      }
    }
  }
}
</style>
