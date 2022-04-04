<template>
  <div class="modal is-active">
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
  data(){
    return{
      showModal: true,
    }
  },
  created() {
    this.emitter.on('toggle-modal', (value) => {
      this.showModal = value;
    })
  },
  methods:{
    emitModalClick(){
      this.emitter.emit('toggle-modal', !this.showModal);
    }
  }
}
</script>

<style scoped>

</style>
