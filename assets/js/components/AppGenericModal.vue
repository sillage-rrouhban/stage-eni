<template>
  <div class="modal" :class="{'is-active' : showModalInModal}" v-if="showModalInModal">
    <div class="modal-background" @click="emitModalClick()"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">
          <slot name="title">
          </slot>
        </p>
        <button class="delete" aria-label="close" @click="emitModalClick()"></button>
      </header>
      <section class="modal-card-body">
        <slot name="body">
        </slot>
      </section>
      <footer class="modal-card-foot">
       <slot name="buttons">
       </slot>
      </footer>
    </div>
  </div>
</template>

<script>
export default {
  name: "AppGenericModal",
  props: {
    showModal : Boolean,
  },
  data(){
    return{
      showModalInModal: false,
    }
  },
  mounted() {
    this.showModalInModal = this.showModal;
  },
  methods:{
    emitModalClick(){
      this.emitter.emit('toggle-modal',{
        'modalState': !this.showModalInModal
      })
    }
  }
}
</script>

<style scoped>

</style>