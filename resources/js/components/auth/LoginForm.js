import React, { useState } from 'react';
import axios from 'axios';

const LoginForm = () => {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [errors, setErrors] = useState({});

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const response = await axios.post('/api/login', { email, password });
            localStorage.setItem('token', response.data.token);
            window.location.href = '/';
        } catch (error) {
            setErrors(error.response.data.errors || {});
        }
    };

    return (
        <form onSubmit={handleSubmit}>
            <div className="mb-4">
                <label>Email</label>
                <input 
                    type="email" 
                    value={email} 
                    onChange={(e) => setEmail(e.target.value)} 
                    className="w-full p-2 border rounded"
                />
                {errors.email && <p className="text-red-500">{errors.email[0]}</p>}
            </div>

            <div className="mb-4">
                <label>Contraseña</label>
                <input 
                    type="password" 
                    value={password} 
                    onChange={(e) => setPassword(e.target.value)} 
                    className="w-full p-2 border rounded"
                />
                {errors.password && <p className="text-red-500">{errors.password[0]}</p>}
            </div>

            <button type="submit" className="w-full bg-blue-600 text-white p-2 rounded">
                Iniciar sesión
            </button>
        </form>
    );
};

export default LoginForm;
