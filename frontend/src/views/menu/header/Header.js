import React from 'react';
import './styles/styles.css';
import { useNavigate } from 'react-router-dom';
import { connectionData, endpoint } from '../../../connection/apiConnection';
import PropTypes from 'prop-types';


const Header = (props) => {
    const navigate = useNavigate();
    const handleNavLink = async () => {
        const userString = localStorage.getItem('user');
        const user = userString ? JSON.parse(userString) : null;
        if (user) {
            await saveDataSettings(user.id);
            localStorage.removeItem('user');
        }
        navigate("/login");
    };
    const saveDataSettings = async (userId) => {
        try {
            const result = await connectionData(endpoint, 'settings/store', 'POST',props.settings);
            console.log(result);
        } catch (error) {
            console.error('Error al obtener configuraciones:', error);
        }
    };
    return (
        <div className="header-component row w-100">
            <div className='col-3 d-flex justify-content-center align-items-center'>LG</div>
            <div className="col d-flex justify-content-center align-items-center">
                <input className='form-control input-component' value={props.keyWordFilter} onChange={(e) => props.setKeyWordFilter(e.target.value)} placeholder='Keyword' />
            </div>
            <div className='col-3 d-flex justify-content-end align-items-center'>
                <a onClick={handleNavLink} className='btn btn-outline-light'>Log Out a</a>
            </div>
        </div>
    )
}
Header.propTypes = {
    keyWordFilter: PropTypes.string.isRequired,
    setKeyWordFilter: PropTypes.func.isRequired,
    settings: PropTypes.object.isRequired,
};
export default Header;