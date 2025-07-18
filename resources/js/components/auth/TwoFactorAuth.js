import React, { useState } from 'react';
import axios from 'axios';

const TwoFactorAuth = ({ onVerify }) => {
    const [code, setCode] = useState('');
    const [error, setError] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const response = await axios.post('/api/2fa/verify', { code });
            onVerify(response.data.token);
        } catch (err) {
            setError('Código de verificación inválido');
        }
    };

    return (
        <form onSubmit={handleSubmit} className="p-4">
            <h2 className="text-xl font-bold mb-4">Verificación en 2 pasos</h2>
            {error && <div className="text-red-500 mb-4">{error}</div>}
            
            <div className="mb-4">
                <label>Código de autenticación</label>
                <input 
                    type="text"
                    value={code}
                    onChange={(e) => setCode(e.target.value)}
                    className="w-full p-2 border rounded"
                    maxLength="6"
                />
            </div>

            <button 
                type="submit" 
                className="w-full bg-blue-600 text-white p-2 rounded"
            >
                Verificar
            </button>
        </form>
    );
};

export default TwoFactorAuth;
