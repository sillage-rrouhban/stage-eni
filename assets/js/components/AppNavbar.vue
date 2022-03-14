<template>
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" href="https://bulma.io">
        <img src="https://bulma.io/images/bulma-logo.png">
      </a>

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
        <div class="navbar-item">
          <div class="buttons">
            <a class="button is-primary">
              <strong>{{$t("navbar.signup")}}</strong>
            </a>
            <a class="button is-light">
              Log in
            </a>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "AppNavbar"
}
</script>

<style scoped lang="scss">
@import "styles/abstract/all";
.navbar {
  padding:1.250rem 3.125rem 1.875rem;
  &-brand{
    img{
      max-height:3.750rem;
    }
  }
  &-menu{
    font-size:1.125rem;
    font-weight:400;

  }
  &-end{
    font-size:1rem;
    font-weight:400;
  }


}



</style>