import React from 'react';
import PropTypes from 'prop-types';
const CardBody = (props) => {
    return (
        <div className="card-body">
            <p className="card-text">{props.description}</p>
        </div>
    );
}
CardBody.propTypes = {
    description: PropTypes.string.isRequired,
};
export default CardBody;
