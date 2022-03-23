<template>
  <footer class="footer columns">
    <div class="column footer__icons">
      <img :src="twitter">
      <img :src="linkedin">
    </div>

    <div class="column footer__links">
      <div class="columns is-justify-content-flex-end">
        <div class="column is-one-fifth has-text-right">
          <a href="#">{{$t("footer.legal_notice")}}</a>
        </div>
        <div class="column is-one-fifth has-text-right">
          <a href="#">{{$t("footer.contact_us")}}</a>
        </div>


      </div>


    </div>
  </footer>

</template>

<script>
export default {
  name: "AppFooter",
  data(){
    return{
      twitter:require('/assets/images/common/twitter.svg'),
      linkedin:require('/assets/images/common/linkedin.svg'),
    }
  }
}
</script>

<style scoped lang="scss">
.footer{
  padding: 3.125rem 2.188rem;

  &__icons{
      img{
        width: 1.875rem;
        &:first-of-type{
          margin-right:1.250em;
        }
      }
   }
  &__links{
    a{
      color: black;
      text-decoration: underline;
    }
  }

}



</style>