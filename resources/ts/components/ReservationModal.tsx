import React from 'react';

interface ReservationModalProps {
  isOpen: boolean;
  onClose: () => void;
  onReserve: () => void;
}

const ReservationModal: React.FC<ReservationModalProps> = ({ isOpen, onClose, onReserve }) => {
  if (!isOpen) return null;

  return (
    <div className="modal">
      <div className="modal-content">
        <h2>予約詳細</h2>
        <button onClick={onReserve}>参加予約</button>
        <button onClick={onClose}>閉じる</button>
      </div>
    </div>
  );
};

export default ReservationModal;
