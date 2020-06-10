import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ProdutctNewModalComponent } from './product-new-modal.component';

describe('ProdutctNewModalComponent', () => {
  let component: ProdutctNewModalComponent;
  let fixture: ComponentFixture<ProdutctNewModalComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ProdutctNewModalComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ProdutctNewModalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
