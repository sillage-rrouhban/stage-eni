<template>
  <div class="account">
    <app-navbar/>
    <div class="columns is-marginless is-multiline">
      <template v-if="isAuthenticated">
        <app-account-navigation/>
        <app-account-aside class="column is-one-fifth"/>
        <app-account-information class="column is-four-fifths" :me="me" v-if="selectedPanel === 1"/>
        <app-account-studies class="column is-four-fifths" v-if="selectedPanel=== 2"/>
        <app-account-online-presence class="column is-four-fifths" v-if="selectedPanel=== 3"/>
        <app-account-settings class="column is-four-fifths" v-if="selectedPanel === 4"/>
      </template>
      <div class="is-full" v-else>
        Connectez vous pour avoir accès à cette page.
      </div>
    </div>
    <app-footer/>
  </div>
</template>

<script>
import AppNavbar from "../components/AppNavbar";
import AppFooter from "../components/AppFooter";
import AppAccountNavigation from "../components/account/AppAccountNavigation";
import AppAccountAside from "../components/account/AppAccountAside";
import AppAccountInformation from "../components/account/AppAccountInformation";
import AppAccountSettings from "../components/account/AppAccountSettings";
import AppAccountOnlinePresence from "../components/account/AppAccountOnlinePresence";
import AppAccountStudies from "../components/account/AppAccountStudies";
import {mapGetters} from "vuex";


export default {
  name: "AppAccount",
  components: {
    AppAccountAside,
    AppAccountInformation,
    AppAccountNavigation,
    AppAccountOnlinePresence,
    AppAccountSettings,
    AppAccountStudies,
    AppFooter,
    AppNavbar
  },
  data() {
    return {
      selectedPanel: 1
    }
  },
  computed: {
    ...mapGetters({
      isAuthenticated: 'security/isAuthenticated',
      me: 'security/user',
    }),
  },

  async created() {
    this.emitter.on('navigate-to', (e) => {
      this.selectedPanel = e.panelSelected;
    })
    await this.$store.dispatch('security/tryLogin');
  },
  async mounted(){

  }
}
</script>

<style scoped lang="scss">

</style>
