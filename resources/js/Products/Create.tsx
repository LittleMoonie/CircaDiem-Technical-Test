import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';

const Create = ({ categories }: any) => {
    const [form, setForm] = useState({
        name: '',
        description: '',
        base_price: '',
        category_id: '',
    });

    const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
        setForm({ ...form, [e.target.name]: e.target.value });
    };

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        Inertia.post('/products', form);
    };

    return (
        <form onSubmit={handleSubmit} className="max-w-lg mx-auto">
            <div>
                <label>Name</label>
                <input
                    type="text"
                    name="name"
                    value={form.name}
                    onChange={handleChange}
                    className="border p-2 w-full"
                />
            </div>
            <div>
                <label>Description</label>
                <textarea
                    name="description"
                    value={form.description}
                    onChange={handleChange}
                    className="border p-2 w-full"
                />
            </div>
            <div>
                <label>Price</label>
                <input
                    type="number"
                    name="base_price"
                    value={form.base_price}
                    onChange={handleChange}
                    className="border p-2 w-full"
                />
            </div>
            <div>
                <label>Category</label>
                <select
                    name="category_id"
                    value={form.category_id}
                    onChange={handleChange}
                    className="border p-2 w-full"
                >
                    <option value="">None</option>
                    {categories.map((category: any) => (
                        <option key={category.id} value={category.id}>
                            {category.name}
                        </option>
                    ))}
                </select>
            </div>
            <button type="submit" className="bg-blue-500 text-white p-2 mt-4">
                Save
            </button>
        </form>
    );
};

export default Create;
