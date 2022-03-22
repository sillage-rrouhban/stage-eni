<template>
  <div class="account">
    <app-navbar/>
    <app-account-navigation/>
    <div class="columns">
      <app-account-aside class="column is-one-fifth"/>
      <app-account-information class="column is-four-fifths" v-if="selectedPanel === 1"/>
      <app-account-studies v-if="selectedPanel=== 2"/>
      <app-account-online-presence v-if="selectedPanel=== 3"/>
      <app-account-setting v-if="selectedPanel === 4"/>

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
import AppAccountSetting from "../components/account/AppAccountSetting";
import AppAccountOnlinePresence from "../components/account/AppAccountOnlinePresence";
import AppAccountStudies from "../components/account/AppAccountStudies";

export default {
  name: "AppAccount",
  components: {
    AppAccountStudies,
    AppAccountOnlinePresence,
    AppAccountSetting, AppAccountInformation, AppAccountAside, AppAccountNavigation, AppFooter, AppNavbar
  },
  data() {
    return {
      selectedPanel: 1
    }
  },
  created() {
    this.emitter.on('navigate-to', (e) => {
      this.selectedPanel = e.panelSelected;
    })
  }
}
</script>

<style scoped lang="scss">

</style>