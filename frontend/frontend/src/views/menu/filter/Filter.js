import React from 'react';
import PropTypes from 'prop-types';
import './styles/styles.css';

const Filter = (props) => {
    return (
        <div className="filter-component row w-100">
            <div className="col m-1">
                <label className='text-white' htmlFor="dateFilter">Date:</label>
                <input 
                    className="input-filter-component form-control" 
                    type='date' 
                    value={props.dateFilter} 
                    onChange={(e) => props.setDateFilter(e.target.value)} 
                    placeholder='Date' 
                />
            </div>
            <div className="col m-1">
                <label className='text-white' htmlFor="categoryFilter">Author:</label>
                <input 
                    className="input-filter-component form-control" 
                    type='text' 
                    value={props.categoryFilter} 
                    onChange={(e) => props.setCategoryFilter(e.target.value)} 
                    placeholder='Author' 
                />
            </div>
            <div className="col m-1">
                <label className='text-white' htmlFor="sourceFilter">Source:</label>
                <input 
                    className="input-filter-component form-control" 
                    type='text' 
                    value={props.sourceFilter} 
                    onChange={(e) => props.setSourceFilter(e.target.value)} 
                    placeholder='Source' 
                />
            </div>
        </div>
    );
}
Filter.propTypes = {
    dateFilter: PropTypes.string.isRequired,
    categoryFilter: PropTypes.string.isRequired,
    sourceFilter: PropTypes.string.isRequired,
    setDateFilter: PropTypes.func.isRequired,
    setCategoryFilter: PropTypes.func.isRequired,
    setSourceFilter: PropTypes.func.isRequired,
};
export default Filter;

