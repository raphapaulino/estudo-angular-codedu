import { Injectable } from '@angular/core';
// import { alert, info, ModuleEntry, defaultModules } from '@pnotify/core';
// import * as PNotifyBootstrap4 from '@pnotify/bootstrap4';
// import * as PNotifyFontAwesome4 from '@pnotify/font-awesome4';
// import * as Confirm from "@pnotify/confirm";
// import '@pnotify/core/dist/BrightTheme.css';
// import "@pnotify/confirm/dist/PNotifyConfirm.css";
// import '@pnotify/bootstrap4/dist/PNotifyBootstrap4.css';

// import '@pnotify/core/dist/PNotify.css';
// import '@pnotify/mobile/dist/PNotifyMobile.css';
// import * as PNotifyMobile from '@pnotify/mobile';


// defaultModules.set(PNotifyBootstrap4, {});
// defaultModules.set(PNotifyFontAwesome4, {});
// // defaultModules.set(PNotifyMobile, {});

@Injectable({
  providedIn: 'root'
})
export class NotifyMessageService {

  getPNotifyAlert() {
    return alert;
  }

  constructor() { }

  public success(text: string) {
    let test = this.alert(text, Types.success);
    console.log('Teste: ');
    console.log(test);
  }

  public error(text: string) {
    this.alert(text, Types.error);
  }

  private alert(text: string, type: Types) {
    return alert({text, type});
    // this.pnotify.alert({text, type});
  }

  // private get pnotify() {
  //   PNotifyButtons;
  //   return PNotify;
  // }

  // title = "PNotify";

  // // Not working. Follow repo converstations @source https://github.com/sciactive/pnotify/issues
  // public onClick() {
  //   info({
  //     title: "Button Clicked",
  //     text:
  //       "You have clicked the button. You may now complete the process of reading the notice.",
  //       modules: new Map([
  //         [
  //           Confirm,
  //           {
  //             confirm: true,
  //             buttons: [
  //               {
  //                 text: "Ok",
  //                 primary: true,
  //                 click: notice => {
  //                   notice.close();
  //                 }
  //               }
  //             ]
  //           }
  //         ] as ModuleEntry<typeof Confirm>
  //       ])
  //   });
  // }
}

enum Types {
  success = 'success',
  error = 'error'
}
