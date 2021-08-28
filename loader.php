<style>
  * {
    margin: 0;
    padding: 0;
  }

  .loader-container {
    position: fixed !important;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    z-index: 1000;
    background: #191241;
    width: 100vw;
    height: 100vh;
    position: relative;
  }

  .loader {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
  }

  .overlay {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 100%;
    z-index: 1000;
  }

  .loader img {
    width: 70%;
  }
</style>


<div class="loader-container">
  <div class="loader">
    <div class="overlay"></div>
    <img src="imgs/loader.gif" alt="">
  </div>
</div>