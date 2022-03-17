<template>
  <div class="loader-container">
    <div class='loader loader--circularSquare'></div>
  </div>
</template>

<script>
export default {
  name: "AppLoader"
}
</script>

<style scoped lang="scss">
.loader-container {
  align-content: center;
  background-color: white;
  bottom: 0;
  display: flex;
  flex-direction: column;
  justify-content: center;
  left: 0;
  position: fixed;
  right: 0;
  top: 0;
  z-index: 100;
  .loader {
    margin: 5em auto;
    &--circularSquare {
      $d: 1.25em;
      $ic: #3D302A;
      $tlc: #2ecc71;
      $trc: #FEE5C2;
      $blc: #2ecc71;
      $brc: #f1c40f;

      width: 0; height: 0;
      box-shadow: -$d/2 (-$d/2) 0 $d/2 $ic, $d/2 (-$d/2) 0 $d/2 $ic,
      -$d/2   $d/2  0 $d/2 $ic, $d/2   $d/2  0 $d/2 $ic;
      animation: circSquare 1.5s ease-in-out infinite;

      @at-root {
        @keyframes circSquare {

          50% {
            width: $d; height: $d;
            border-radius: 50%;
            transform: rotate(.5turn);
            box-shadow: -2*$d 0 0 $tlc, 2*$d 0 0 $trc,
            -2*$d 0 0 $blc, 2*$d 0 0 $brc;
          }
          80%, 100% { transform: rotate(1turn); }
        }
      }
    }
  }
}
</style>
