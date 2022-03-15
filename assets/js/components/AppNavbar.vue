<template>
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <img :src="logo">
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
        <a class="navbar-item" href="#">
          {{ $t("navbar.signup") }}
        </a>
        <a class="navbar-item" href="#">
          {{ $t("navbar.languages") }}
        </a>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "AppNavbar",
  data(){
    return{
      logo: require('/assets/images/common/logo.svg'),
    }
}

}
</script>

<style scoped lang="scss">
@import "styles/abstract/all";
.navbar {
  padding:1.250rem 3.125rem 1.875rem;
  text-transform:uppercase;
  &-brand{
    margin-right:3.125rem;
    img{

      width: 6.542vw;
    }
  }
  &-menu{
    font-size:1.125rem;
    font-weight:400;

  }
  &-end{
    font-size:1rem;
    font-weight:400;
    align-items: flex-start;
  }



}



</style>