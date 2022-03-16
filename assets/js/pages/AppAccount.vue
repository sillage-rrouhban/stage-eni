<template>
  <div class="account">
    <app-navbar/>
    <app-account-navigation/>
    <div class="columns">
      <app-account-aside class="column is-one-fifth"/>
    <!--  <app-account-information class="column is-four-fifths" v-if="selectedPanel === 0"/> -->
      <app-account-setting/>
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

export default {
  name: "AppAccount",
  components: {AppAccountSetting, AppAccountInformation, AppAccountAside, AppAccountNavigation, AppFooter, AppNavbar},
  data() {
    return {
      selectedPanel: 0
    }
  }
}
</script>

<style scoped lang="scss">

</style>