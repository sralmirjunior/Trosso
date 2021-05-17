<template>
  <ion-page>
    <ion-header>
      <!--Menu com a logo e o nome do aplicativo-->
      <ion-toolbar color="primary" class="ion-text-left">
        <ion-buttons slot="start">
          <ion-back-button :default-href="pageBackLink"></ion-back-button>
        </ion-buttons>
        <ion-title color="light">{{ pageTitle }}</ion-title>
      </ion-toolbar>
    </ion-header>
    <!--Conteudo-->
    <ion-content :fullscreen="true">
      <slot />
    </ion-content>
    <!-- Footer -->
    <ion-footer color="primary">
      <slot name="footer"></slot>
    </ion-footer>
  </ion-page>
</template>

<script>
import {
  IonContent,
  IonHeader,
  IonPage,
  IonTitle,
  IonToolbar,
  IonButtons,
  IonBackButton,
  IonFooter,
} from "@ionic/vue";

export default {
  props: ["pageTitle", "pageBackLink"],
  components: {
    IonContent,
    IonHeader,
    IonPage,
    IonTitle,
    IonToolbar,
    IonButtons,
    IonBackButton,
    IonFooter,
  },
};
</script>

<style scoped>
ion-title {
  text-transform: uppercase;
  font-size: 30px;
}
</style>
