export interface Category {
    id?: number; 
    name: string; 
    readonly slug?: string; 
    is_active: boolean; 
    readonly created_at?: string;
    readonly updated_at?: string;
}

export interface Product {
    id?: number;
    name: string;
    description: string;
    price: number;
    readonly slug?: string;
    is_active: boolean;
    readonly created_at?: string;
    readonly updated_at?: string;
}

export interface ProductCategory {
    product: Product;
    categories: Category[]
}

export interface User {
    id?: number;
    name: string;
    email: string;
    password?: string;
    readonly created_at?: string;
    readonly updated_at?: string;
}
