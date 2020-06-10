import { Component, OnInit, ViewChild, Output, EventEmitter } from '@angular/core';
import { ModalComponent } from 'src/app/components/bootstrap/modal/modal.component';
import { HttpErrorResponse } from '@angular/common/http';
import { CategoryHttpService } from 'src/app/services/http/category-http.service';
import { FormGroup, FormBuilder, Validators, AbstractControl } from '@angular/forms';
import fieldsOptions from '../category-form/category-fields-options';

// Exemplo 1
// function myValidator(control: AbstractControl) {
//   if (control.value === 'paulino') {
//     return null;
//   }
//   return {paulino: true};
// }

// Exemplo 2
// function myValidator(param1) {
//   function (control: AbstractControl) {
//     if (control.value === 'paulino') {
//       return null;
//     }
//     return {paulino: true};
//   }
// }

@Component({
  selector: 'category-new-modal',
  templateUrl: './category-new-modal.component.html',
  styleUrls: ['./category-new-modal.component.css']
})
export class CategoryNewModalComponent implements OnInit {
  
  // description: FormControl;
  form: FormGroup;
  errors = {};

  @ViewChild(ModalComponent) modal: ModalComponent

  @Output() onSuccess: EventEmitter<any> = new EventEmitter<any>();
  @Output() onError: EventEmitter<HttpErrorResponse> = new EventEmitter<HttpErrorResponse>();
  
  constructor(private categoryHttp: CategoryHttpService, private formBuilder: FormBuilder) {
    const maxLength = fieldsOptions.name.validationMessage.maxlength;
    // this.description = new FormControl();
    this.form = this.formBuilder.group({
      // name: 'asdfasdçfkmasçldfkmçasdmfçalskmdfçlk mçalksmdfçlaksmdçalkmsdçflkm çlakmsdfçlkamsçdlfkmaçsdlfmçaslkm açsdflkmmaçslkdfmçaslkdmf çlkamdfsçlkam çslkdmfçaslkdfmçaslkdmfçaslkmdfçalksmfçlaksmdçflkamsçlkfmçsalfmçlsdamflk asdfasdçfkmasçldfkmçasdmfçalskmdfçlk mçalksmdfçlaksmdçalkmsdçflkm çlakmsdfçlkamsçdlfkmaçsdlfmçaslkm açsdflkmmaçslkdfmçaslkdmf çlkamdfsçlkam çslkdmfçaslkdfmçaslkdmfçaslkmdfçalksmfçlaksmdçflkamsçlkfmçsalfmçlsdamflk',
      // name: ['', [Validators.required, Validators.maxLength(255), myValidator]],
      name: ['', [Validators.required, Validators.maxLength(maxLength)]],
      // name: [''],
      is_active: true
    });
  }

  ngOnInit(): void {
  }

  submit() {
    this.categoryHttp
      .create(this.form.value)
      .subscribe((category) => {
        this.form.reset({
          name: '',
          is_active: true
        });
        this.onSuccess.emit(category);
        this.modal.hide();
      }, responseError => {
        if (responseError.status === 422) {
          this.errors = responseError.error.errors;
        }
        this.onError.emit(responseError);
      });
    // this.categoryHttp
    //   .create(this.category)
    //   .subscribe((category) => {
    //     this.onSuccess.emit(category);
    //     this.modal.hide();
    //   }, error => this.onError.emit(error));
  }

  showModal() {
    this.modal.show();
    // setTimeout(() => {
    //   this.modal.hide()
    // }, 3000);
  }

  showErrors() {
    return Object.keys(this.errors).length != 0;
  }

  hideModal($event: Event) {
    // this.modal.hide();
    // console.log($event);
  }
}
