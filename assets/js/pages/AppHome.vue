<template>
  <div>
    <app-navbar/>
    <div class="columns home-header">
      <div class="column is-three-fifths">
        <h1 class="is-size-1 ">Lorem ipsum dolor sit amet</h1>
        <p>Lorem ipsum dolor sit amet. Ea voluptas enim qui excepturi similique ad deserunt
          nobis et consequatur omnis
          quo
          facere quasi. Deserunt dolorem aut autem Quis et itaque temporibus ea architecto vero. Et aspernatur dolores a
          ullam
          nisi non reprehenderit ipsum qui voluptatum laudantium est molestiae odio et minus repudiandae. Aut debitis
          tempora est
          maiores adipisci ut quia asperiores id neque aliquid. </p>
      </div>
      <div class="column is-two-fifths">
        <div class="buttons">
          <button class="button">Parcourir les offres</button>
        </div>
        <div class="buttons">
          <button class="button">Parcourir les entreprises</button>
        </div>
      </div>
    </div>

    <div class="columns is-centered">
      <div class="column is-one-third has-text-centered">
        <h2 class="is-size-2">1000</h2>
        <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
        <h3 class="is-size-3">ETUDIANTS</h3>

      </div>
      <div class="column is-one-third has-text-centered">
        <h2 class="is-size-2">1000</h2>
        <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
        <h3 class="is-size-3">RECRUTEURS</h3>
      </div>
    </div>

    <app-footer/>


  </div>
</template>

<script>
import AppNavbar from "../components/AppNavbar";
import AppFooter from "../components/AppFooter";

export default {
  name: "AppHome",
  components: {AppFooter, AppNavbar}
}
</script>

<style scoped lang="scss">
.home-header{

}

</style>