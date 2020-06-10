import {Injectable} from '@angular/core';
import { NotifyMessageService } from 'src/app/services/notify-message.service';
import { CategoryListComponent } from './category-list.component';
import { HttpErrorResponse } from '@angular/common/http';

@Injectable({
    providedIn: 'root'
})
export class CategoryInsertService {

	private _categoryListComponent: CategoryListComponent;

	constructor(private notifyMessage: NotifyMessageService) { }

	set categoryListComponent(value: CategoryListComponent) {
		// console.log(value);
		this._categoryListComponent = value;
	}

	showModalInsert() {
		// console.log(this._categoryListComponent)
		this._categoryListComponent.categoryNewModal.showModal();
	}

	onInsertSuccess($event: any) {
		// this.alert = this.notifyMessage.success('Categoria cadastrada com sucesso.');
		// console.log($event);
		this._categoryListComponent.getCategories();
	}
	
	onInsertError($event: HttpErrorResponse) {
		// console.log($event);
	}
}