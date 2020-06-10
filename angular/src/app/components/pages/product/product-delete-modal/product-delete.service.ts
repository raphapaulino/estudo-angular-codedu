import { Injectable } from '@angular/core';
import { NotifyMessageService } from 'src/app/services/notify-message.service';
import { HttpErrorResponse } from '@angular/common/http';
import { ProductListComponent } from '../product-list/product-list.component';

@Injectable({
  providedIn: 'root'
})
export class ProductDeleteService {

	private _productListComponent: ProductListComponent;

	constructor(private notifyMessage: NotifyMessageService) {
	}

	set productListComponent(value: ProductListComponent) {
		this._productListComponent = value;
	}

	showModalDelete(productId: number) {
    this._productListComponent.productId = productId;
    this._productListComponent.productDeleteModal.showModal();
	}

	onDeleteSuccess($event: any) {
		// this.notifyMessage.success('Categoria atualizada com sucesso.');
		console.log($event);
		this._productListComponent.getCategories();
	}
  
  onDeleteError($event: HttpErrorResponse) {
		// this.notifyMessage.success('Categoria excluída com sucesso.');
    console.log($event);
  }

}
