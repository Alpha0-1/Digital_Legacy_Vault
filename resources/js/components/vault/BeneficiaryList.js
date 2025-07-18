import React from 'react';

const BeneficiaryList = ({ beneficiaries, onAddBeneficiary }) => {
    return (
        <div className="mt-6">
            <div className="flex justify-between items-center mb-4">
                <h2 className="text-lg font-semibold">Beneficiaries</h2>
                <button 
                    onClick={onAddBeneficiary}
                    className="bg-green-600 text-white px-3 py-1 rounded text-sm"
                >
                    + Add
                </button>
            </div>
            
            {beneficiaries.length === 0 ? (
                <p className="text-sm text-gray-500">No beneficiaries assigned</p>
            ) : (
                <ul className="space-y-2">
                    {beneficiaries.map((beneficiary, index) => (
                        <li 
                            key={index} 
                            className="bg-gray-50 p-3 rounded-md text-sm"
                        >
                            <div>{beneficiary.name}</div>
                            <div className="text-gray-500">{beneficiary.email}</div>
                        </li>
                    ))}
                </ul>
            )}
        </div>
    );
};

export default BeneficiaryList;
