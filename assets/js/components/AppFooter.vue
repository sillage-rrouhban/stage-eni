<template>
  <footer class="footer columns">
    <div class="column">
      <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
      <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
    </div>

    <div class="column">
      <div class="columns is-justify-content-flex-end">
        <div class="column is-one-fifth has-text-right">
          <a href="#">{{$t("footer.legal-notice")}}</a>
        </div>
        <div class="column is-one-fifth has-text-right">
          <a href="#">{{$t("footer.contact-us")}}</a>
        </div>


      </div>


    </div>
  </footer>

</template>

<script>
export default {
  name: "AppFooter"
}
</script>

<style scoped>

</style>