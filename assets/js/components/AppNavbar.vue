<template>
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <img :src="logo" alt="">
    </div>

    <div class="navbar-menu">
      <div class="navbar-start">
        <a class="navbar-item" href="#">
          {{ $t("navbar.offers") }}
        </a>
        <a class="navbar-item" href="#">
          {{ $t("navbar.companies") }}
        </a>
        <a class="navbar-item" href="#">
          {{ $t("navbar.schools") }}
        </a>
      </div>
      <div class="navbar-end">
        <div class="navbar-item" @click="emitModalClick">
          {{ $t("navbar.signup") }}
        </div>
        <a class="navbar-item" href="#">
          {{ $t("navbar.languages") }}
        </a>
        <app-modal/>
      </div>
    </div>
  </nav>
</template>

<script>
import AppModal from "./AppModal";
export default {
  name: "AppNavbar",
  components: {AppModal},
  data(){
    return{
      logo: require('/assets/images/common/logo.svg'),
      showModal:false,
    }
},
  methods: {
    emitModalClick() {
      this.emitter.emit('modal-state', {
        'modalState': true
      })
    },
  }
}
</script>

<style scoped lang="scss">
@import "styles/abstract/all";
.navbar {
  padding:1.250rem 3.125rem 1.875rem;
  &-brand {
    margin-right:3.125rem;
    img {
      width: 6.542vw;
    }
  }
  &-menu {
    font-size:1.125rem;
    font-weight:400;
  }
  &-item {
    cursor: pointer;
    text-transform:uppercase;
    &:not(:last-of-type) {
      margin-right: 2.5rem;
    }
    &:hover {
      background-color: transparent;
    }
  }
  &-end {
    font-size:1rem;
    font-weight:400;
    align-items: flex-start;
  }
}



</style>
