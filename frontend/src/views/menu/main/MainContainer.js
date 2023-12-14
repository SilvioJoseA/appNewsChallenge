import React from 'react';
import PropTypes from 'prop-types';
import Table from './Table';
import './styles/styles.css';
const MainContainer = (props) => {
    return (
        <div className="menu-container-component row w-100 mt-1">
            <div className="col w-100 d-flex align-items-center text-muted">
                <Table data={props.data} />
            </div>            
        </div>
    );
};
MainContainer.propTypes = {
    data: PropTypes.array.isRequired,
};
export default MainContainer;
