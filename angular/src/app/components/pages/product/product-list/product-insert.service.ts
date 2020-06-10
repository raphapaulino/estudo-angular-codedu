import {Injectable} from '@angular/core';
import { NotifyMessageService } from 'src/app/services/notify-message.service';
import { ProductListComponent } from './product-list.component';
import { HttpErrorResponse } from '@angular/common/http';

@Injectable({
    providedIn: 'root'
})
export class ProductInsertService {

	private _productListComponent: ProductListComponent;

	constructor(private notifyMessage: NotifyMessageService) {

	}

	set productListComponent(value: ProductListComponent) {
		this._productListComponent = value;
	}

	showModalInsert() {
		this._productListComponent.productNewModal.showModal();
	}

	onInsertSuccess($event: any) {
    // this.alert = this.notifyMessage.success('Categoria cadastrada com sucesso.');
    console.log($event);
    this._productListComponent.getCategories();
  }
  
  onInsertError($event: HttpErrorResponse) {
    console.log($event);
  }
}