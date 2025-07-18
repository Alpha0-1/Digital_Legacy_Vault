import React, { useState } from 'react';

const LegacyItemForm = ({ vaultId, onClose }) => {
    const [title, setTitle] = useState('');
    const [content, setContent] = useState('');
    const [itemType, setItemType] = useState('document');
    const [beneficiaries, setBeneficiaries] = useState([]);

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            await fetch('/api/legacy-items', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                },
                body: JSON.stringify({
                    title, content, itemType, vault_id: vaultId, beneficiaries
                })
            });
            onClose();
        } catch (error) {
            console.error('Error creating legacy item', error);
        }
    };

    return (
        <form onSubmit={handleSubmit}>
            <div className="mb-4">
                <label>Título</label>
                <input 
                    type="text"
                    value={title}
                    onChange={(e) => setTitle(e.target.value)}
                    className="w-full p-2 border rounded"
                />
            </div>

            <div className="mb-4">
                <label>Tipo</label>
                <select 
                    value={itemType}
                    onChange={(e) => setItemType(e.target.value)}
                    className="w-full p-2 border rounded"
                >
                    <option value="document">Documento</option>
                    <option value="message">Mensaje</option>
                    <option value="account">Cuenta</option>
                </select>
            </div>

            <div className="mb-4">
                <label>Contenido</label>
                <textarea 
                    value={content}
                    onChange={(e) => setContent(e.target.value)}
                    className="w-full p-2 border rounded"
                />
            </div>

            <div className="flex justify-end">
                <button type="submit" className="bg-green-600 text-white px-4 py-2 rounded">
                    Guardar
                </button>
            </div>
        </form>
    );
};

export default LegacyItemForm;
