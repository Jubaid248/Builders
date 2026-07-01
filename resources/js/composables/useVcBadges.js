export function useVcBadges() {
  const statusBadge = (status) => {
    const map = {
      pending: 'vc-badge vc-badge-pending',
      approved: 'vc-badge vc-badge-approved',
      rejected: 'vc-badge vc-badge-rejected',
      in_progress: 'vc-badge vc-badge-in_progress',
      delivered: 'vc-badge vc-badge-delivered',
    };
    return map[status] || 'vc-badge bg-white/10 text-vc-parchment';
  };

  const paymentBadge = (status) => {
    const map = {
      unpaid: 'vc-badge vc-badge-unpaid',
      deposit_paid: 'vc-badge vc-badge-deposit_paid',
      fully_paid: 'vc-badge vc-badge-fully_paid',
    };
    return map[status] || 'vc-badge bg-white/10 text-vc-parchment';
  };

  const paymentLabel = (status) => ({
    unpaid: 'Unpaid',
    deposit_paid: 'Deposit Paid',
    fully_paid: 'Fully Paid',
  }[status] || status);

  const formatStatus = (status) => status?.replace(/_/g, ' ') ?? '';

  return { statusBadge, paymentBadge, paymentLabel, formatStatus };
}
