import {Injectable} from '@angular/core';
import { NotifyMessageService } from 'src/app/services/notify-message.service';
import { HttpErrorResponse } from '@angular/common/http';
import { CategoryListComponent } from '../category-list/category-list.component';

@Injectable({
    providedIn: 'root'
})
export class CategoryDeleteService {

	private _categoryListComponent: CategoryListComponent;

	constructor(private notifyMessage: NotifyMessageService) {
	}

	set categoryListComponent(value: CategoryListComponent) {
		this._categoryListComponent = value;
	}

	showModalDelete(categoryId: number) {
    this._categoryListComponent.categoryId = categoryId;
    this._categoryListComponent.categoryDeleteModal.showModal();
	}

	onDeleteSuccess($event: any) {
		// this.notifyMessage.success('Categoria atualizada com sucesso.');
		this._categoryListComponent.getCategories();
	}
  
  onDeleteError($event: HttpErrorResponse) {
		// this.notifyMessage.success('Categoria excluída com sucesso.');
  }

}