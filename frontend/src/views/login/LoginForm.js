import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import { connectionData, endpoint } from "../../connection/apiConnection";
const LoginForm = () => {
    const [formData, setFormData] = useState({
        email: '',
        password: '',
    });
    const navigate = useNavigate();
    const handleFormChange = (e) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
    };
    const handleForm = async (e) => {
        e.preventDefault();

        if (!formData.email || !formData.password) {
            console.error('Por favor, complete todos los campos del formulario.');
            return;
        }
        try {
            const user = await connectionData(endpoint, 'users/login', 'POST', formData);
            if (user.email === formData.email && user.password === formData.password) {
                const settings = await connectionData(endpoint, 'settings', 'GET', { id: user.id });
                console.log(settings);
                localStorage.setItem('user', JSON.stringify(user));
                navigate('/menu');
            } else {
                navigate('/login');
            }
        } catch (error) {
            console.error('Problema con la API', error);
        }
    };
    return (
        <div className="row">
            <div className="col-12 d-flex justify-content-center align-items-center">
                <div className="card bg bg-dark text-white mt-5">
                    <div className="card-body">
                        <form className="form" onSubmit={handleForm}>
                            <div className="row m-3">
                                <input
                                    name="email"
                                    onChange={handleFormChange}
                                    value={formData.email}
                                    className="col rounded"
                                    placeholder="Email"
                                    type="email"
                                />
                            </div>
                            <div className="row m-3">
                                <input
                                    name="password"
                                    onChange={handleFormChange}
                                    value={formData.password}
                                    className="col rounded"
                                    placeholder="Password"
                                    type="password"
                                />
                            </div>
                            <div className="row m-3">
                                <input className="col btn btn-primary text-white rounded" type="submit" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );
};
export default LoginForm;
