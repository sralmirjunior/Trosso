<template>
  <ion-page>
    <ion-header>
      <!--Menu com a logo-->
      <ion-toolbar color="primary">
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
    <ion-footer color="primary">
      <ion-toolbar color="primary">
        <ion-title @click="openModal" color="light"
          >Adicionar quadro
        </ion-title>
      </ion-toolbar>
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
  modalController,
} from "@ionic/vue";

import ModalAddBoard from "./ModalAddBoard";

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
  methods: {
    async openModal() {
      const modal = await modalController.create({
        component: ModalAddBoard,
      });
      return modal.present();
    },
  },
};
</script>

<style scoped>
ion-title {
  text-transform: uppercase;
  font-size: 30px;
  display: flex;
  align-items: center;
  justify-items: center;
}

ion-footer ion-toolbar {
  border-radius: 12px 12px 0 0;
}

ion-footer ion-title {
  text-align: center;
  font-size: 16px;
}

ion-icon {
  width: 100px;
}
</style>
