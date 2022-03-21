<template>
  <div class="modal " :class="{'is-active' : showModal}" v-if="showModal">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">Modal title</p>
        <button class="delete" aria-label="close" @click="showModal = false"></button>
      </header>
      <section class="modal-card-body has-text-centered">
        <button class="button">{{ $t("modal.login") }}</button>
        <a  href="/register" class="button">{{ $t("modal.register") }}</a>
      </section>
    </div>
  </div>

</template>

<script>
export default {
  name: "AppModal",
  data () {
    return{
      showModal: false,
    }
  },
  created() {
    this.emitter.on('modal-state',(e)=>{
      this.showModal = e.modalState;
    })
  },
}
</script>

<style scoped lang="scss">


</style>