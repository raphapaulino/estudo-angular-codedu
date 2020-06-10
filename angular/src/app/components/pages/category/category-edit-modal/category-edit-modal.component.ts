import { Component, OnInit, ViewChild, Input, Output, EventEmitter } from '@angular/core';
import { ModalComponent } from 'src/app/components/bootstrap/modal/modal.component';
import { HttpErrorResponse } from '@angular/common/http';
import { CategoryHttpService } from 'src/app/services/http/category-http.service';
import { FormGroup, FormBuilder } from '@angular/forms';

@Component({
  selector: 'category-edit-modal',
  templateUrl: './category-edit-modal.component.html',
  styleUrls: ['./category-edit-modal.component.css']
})
export class CategoryEditModalComponent implements OnInit {

  _categoryId: number;

  form: FormGroup;
  
  @ViewChild(ModalComponent) modal: ModalComponent

  @Output() onSuccess: EventEmitter<any> = new EventEmitter<any>();
  @Output() onError: EventEmitter<HttpErrorResponse> = new EventEmitter<HttpErrorResponse>();
  
  constructor(private categoryHttp: CategoryHttpService, private formBuilder: FormBuilder) {
    this.form = this.formBuilder.group({
      name: '',
      is_active: true
    });
  }

  ngOnInit(): void {
  }

  @Input()
  set categoryId(value) {
    this._categoryId = value;
    if (this._categoryId) {
      this.categoryHttp
        .get(this._categoryId)
        .subscribe(
          category => this.form.patchValue(category),
          responseError => {
            if (responseError.status == 401) {
              this.modal.hide();
            }
          }
        )
    }
  }

  submit() {
    this.categoryHttp
      .update(this._categoryId, this.form.value)
      .subscribe((category) => {
        this.onSuccess.emit(category);
        this.modal.hide();
      }, error => this.onError.emit(error));
  }

  showModal() {
    this.modal.show();
  }

  hideModal($event: Event) {
    // this.modal.hide();
  }
}
