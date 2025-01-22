import React from 'react';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-react';

const Index = () => {
    const { products } = usePage().props;

    return (
        <div className="container mx-auto">
            <h1 className="text-2xl font-bold mb-4">Product List</h1>
            <table className="table-auto w-full">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                </tr>
                </thead>
                <tbody>
                {products.map((product: any) => (
                    <tr key={product.id}>
                        <td>{product.name}</td>
                        <td>${product.base_price}</td>
                        <td>{product.category?.name || 'Uncategorized'}</td>
                    </tr>
                ))}
                </tbody>
            </table>
        </div>
    );
};

export default Index;
